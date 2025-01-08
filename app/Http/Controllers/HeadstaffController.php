<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\StaffProvince;
use App\Models\Response;
use App\Models\ResponseProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; 
use App\Services\RegionService;

class HeadstaffController extends Controller
{
    public function index(RegionService $regionService)
    {
        // Mendapatkan user yang sedang login
        $staff = auth()->user();

        // Mengambil data provinsi yang terkait dengan staff
        $staffProvince = $staff->staffProvince; // Mengambil relasi staffProvince

        // Menentukan nama provinsi atau default ke 'Unknown'
        $provinceName = $staffProvince ? $staffProvince->province : 'Unknown';

        // Menghitung jumlah pengaduan untuk provinsi tersebut
        $complaintsCount = Report::where('province', $provinceName)->count();

        // Menghitung jumlah tanggapan terkait provinsi tersebut
        $responsesCount = Response::whereHas('report', function ($query) use ($provinceName) {
            $query->where('province', $provinceName);
        })->count();

        $staffProvince->province_name = $regionService->getProvinceName($staffProvince->province);

        // Mengirim data ke view
        return view('headstaff.dashboard', compact('complaintsCount', 'responsesCount', 'staffProvince'));
    }
        
    public function userIndex(RegionService $regionService)
    {
        // Ambil user yang sedang login (headstaff)
        $user = auth()->user();
        
        // Cari provinsi yang terkait dengan headstaff
        $staffProvince = $user->staffProvince;
        
        if (!$staffProvince) {
            abort(403, 'You are not assigned to any province.');
        }
    
        // Ambil semua user yang berperan sebagai staff dan memiliki provinsi yang sama dengan headstaff
        $users = User::where('role', 'staff')
                     ->whereHas('staffProvince', function($query) use ($staffProvince) {
                         $query->where('province', $staffProvince->province);
                     })
                     ->get();
        
        $staffProvince->province_name = $regionService->getProvinceName($staffProvince->province);

                 
        return view('headstaff.user.index', compact('users', 'staffProvince'));
    }

        // Membuat akun baru
    public function store(Request $request)
    {
            // Validasi input
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ]);

    // Ambil provinsi dari headstaff yang sedang login
    $user = auth()->user();
    $headstaffProvince = $user->staffProvince->province;  // Ambil provinsi dari headstaff

    // Buat user staff
    $staff = User::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'staff',
    ]);

    // Simpan ke tabel staff_provinces dengan provinsi yang sama dengan headstaff
    StaffProvince::create([
        'user_id' => $staff->id,
        'province' => $headstaffProvince,
    ]);

    return redirect()->back()->with('success', 'Berhasil Membuat Akun Staff Daerah');
    }

        // Menetapkan provinsi otomatis
    private function assignProvinceToStaff()
    {
        // Ambil daftar provinsi dari API
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

        // Pastikan respon berhasil
        if ($response->successful()) {
            $provinces = $response->json();  // Misalnya API mengembalikan array provinsi
        // Dump data untuk memeriksa struktur data
        // dd($provinces);

            // Ambil kode provinsi yang sudah ditangani
            $assignedProvinces = StaffProvince::pluck('province')->toArray();

            // Cari provinsi yang belum digunakan
            $availableProvince = collect($provinces)->first(function ($province) use ($assignedProvinces) {
                return !in_array($province['id'], $assignedProvinces);  // Asumsi 'code' adalah kode provinsi
            });

            // Jika tidak ada provinsi yang tersedia
            if (!$availableProvince) {
                abort(400, 'Semua provinsi telah ditangani.');
            }

            return $availableProvince['id'];  // Kembalikan kode provinsi yang belum digunakan
        }

        abort(500, 'Gagal mengambil data provinsi dari API.');
    }

    public function resetPassword($userId)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($userId);

        // Ambil email user
        $email = $user->email;

        // Pisahkan bagian sebelum '@' dan titik untuk mendapatkan kata-kata
        $parts = explode('@', $email);
        $usernameParts = explode('.', $parts[0]);

        // Ambil 4 kata pertama
        $passwordBase = implode('', array_slice($usernameParts, 0, 4));

        // Buat password baru
        $newPassword = $passwordBase;  // Bisa tambahkan angka atau simbol jika perlu

        // Update password user
        $user->password = Hash::make($newPassword);  // Enkripsi password
        $user->save();

        // Kembalikan respons
        return redirect()->back()->with('reset', 'Berhasil Reset Password!');
    }

    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
    
        // Periksa apakah staff memiliki tanggapan
        if ($staff->responses()->exists()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus, Staff sudah pernah membuat tanggapan!');
        }
    
        // Hapus staff
        $staff->delete();
    
        return redirect()->back()->with('success', 'Berhasil Menghapus Akun Staff');
    }

   
}
