<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Report;
use App\Models\StaffProvince;
use App\Models\Response;
use App\Models\ResponseProgress;
use Illuminate\Http\Request;
use App\Services\RegionService;

class StaffController extends Controller
{
    //melihat laporan berdasarkan province
    public function index(Request $request, RegionService $regionService)
    {
    // Ambil user yang sedang login
    $user = auth()->user();

    // Pastikan user memiliki relasi staffProvince
    if (!$user || !$user->staffProvince) {
        abort(403, 'User does not have access to any province.');
    }

    // Ambil provinsi dari relasi
    $province = $user->staffProvince->province;

    // Ambil laporan berdasarkan provinsi
    $reports = Report::where('province', $province)
        ->orderBy('created_at', 'desc')
        ->get();

    // Urutkan berdasarkan vote jika sort berdasarkan votes
    if ($request->sort === 'votes_desc') {
        $reports = $reports->sortByDesc(function ($report) {
            return count(json_decode($report->voting, true)); // Menghitung jumlah vote
        });
    } elseif ($request->sort === 'votes_asc') {
        $reports = $reports->sortBy(function ($report) {
            return count(json_decode($report->voting, true)); // Menghitung jumlah vote
        });
    }

    // Tambahkan nama daerah menggunakan RegionService
    foreach ($reports as $report) {
        $report->province_name = $regionService->getProvinceName($report->province); // Nama provinsi
        $report->regency_name = $regionService->getRegencyName($report->province, $report->regency); // Nama kabupaten/kota
        $report->subdistrict_name = $regionService->getDistrictName($report->regency, $report->subdistrict); // Nama kecamatan
        $report->village_name = $regionService->getVillageName($report->subdistrict, $report->village); // Nama desa/kelurahan
    }

    // Kirim laporan ke view
    return view('staff.dashboard', compact('reports'));
    }


    public function show($reportId, RegionService $regionService)
    {
        // Ambil data laporan beserta status dan progresnya
        $reports = Report::with(['response', 'response.responseProgress',])->findOrFail($reportId);

        // if (is_string($reports->response->responseProgress->histories)) {
        //     $reports->response->responseProgress->histories = json_decode($reports->response->responseProgress->histories, true); // true untuk mendapatkan array
        // }

        $reports->province_name = $regionService->getProvinceName($reports->province);
        $reports->regency_name = $regionService->getRegencyName($reports->province, $reports->regency);
        $reports->subdistrict_name = $regionService->getDistrictName($reports->regency, $reports->subdistrict);
        $reports->village_name = $regionService->getVillageName($reports->subdistrict, $reports->village);
        
        // dd($reports->response, $reports->response->responseProgress);

        return view('staff.tanggapan.index', compact('reports'));
    }

    public function createResponse($id)
    {
        // Cari laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Pastikan ada response terkait
        $response = $report->response;

        // Jika tidak ada tanggapan, buat tanggapan baru
        if (!$response) {
            $response = Response::create([
                'report_id' => $report->id, // Pastikan ada kolom `report_id` di tabel responses
                'response_status' => 'ON_PROCESS', // Status default
                'staff_id' => auth()->id(),
            ]);
        } else {
            // Jika sudah ada tanggapan, perbarui statusnya
            $response->response_status = 'ON_PROCESS';
            $response->save();
        }

        // Redirect ke halaman response_progress
        return redirect()->route('staff.show', ['id' => $report->id])
                         ->with('success', 'Laporan Sedang Diproses.');
    }

    public function reject($id)
    {
        // Cari laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Periksa apakah laporan sudah memiliki respons
        if ($report->response) {
            // Update status jika respons sudah ada
            $report->response->update([
                'response_status' => 'REJECT',
            ]);
        } else {
            // Buat respons baru jika belum ada
            $report->response()->create([
                'response_status' => 'REJECT',
                'staff_id' => auth()->id() ?? 1, // Menggunakan ID staff yang sedang login
            ]);
        }

        // Redirect kembali ke halaman laporan dengan pesan sukses
        return redirect()->route('staff.index')->with('success', 'Laporan telah ditolak.');
    }

    public function createProgress(Request $request, $responseId)
    {
        $request->validate([
            'histories' => 'required|string', // Validasi input
        ]);
    
        $response = Response::find($responseId);
    
        if (!$response) {
            return back()->with('error', 'Response tidak ditemukan');
        }
    
        // Buat progres baru
        ResponseProgress::create([
            'response_id' => $response->id,
            'histories' => json_encode($request->input('histories')), // Ambil data dari request
        ]);
    
        return back()->with('success', 'Progres berhasil ditambahkan!');
    }
    


    public function deleteProgress($progressId)
    {
        $progress = ResponseProgress::findOrFail($progressId);

        if ($progress->response->response_status !== 'ON_PROCESS') {
            return redirect()->back()->with('error', 'Progress tidak dapat dihapus karena status bukan ON_PROCESS!');
        }

        $progress->delete();

        return redirect()->back()->with('success', 'Progress berhasil dihapus!');
    }


    public function completeResponse($id)
    {
        $response = Response::findOrFail($id);

        if ($response->response_status !== 'ON_PROCESS') {
            return redirect()->back()->with('error', 'Hanya tanggapan dengan status ON_PROCESS yang dapat diselesaikan!');
        }

        $response->update(['response_status' => 'DONE']);

        return redirect()->back()->with('success', 'Laporan Telah Terselesaikan!');
    }

}
