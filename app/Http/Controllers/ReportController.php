<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Report;
use \App\Models\comment;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $reports = Report::WHERE('province', 'LIKE', '%'. $request->filter_province . '%')->orderBY('province', 'ASC')->get();

        return view('guest.dashboard', compact('reports'));

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('guest.report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          // Validasi input dari pengguna
          $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'province' => 'required|string',    
            'regency' => 'required|string',
            'subdistrict' => 'required|string',
            'village' => 'required|string',
            'type' => 'required|string|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statement' => 'required|boolean',
        ]);

        // Proses upload image jika ada
        $image = $request->file('image');
        $filename = date('Y-m-d').$image->getClientOriginalName();
        $path = 'image-pengaduan/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($image));
        // $path = null;
        // if ($request->hasFile('image')) {
        //     $path = $request->file('image')->store('public/pengaduan');
        // }
// dd($request->all());
        // Simpan data pengaduan ke database
        Report::create([
            'user_id' => auth()->id(), // Mengambil ID pengguna yang login
            'province' => $request->province,
            'regency' => $request->regency,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $path,
            'statement' => $request->statement,
        ]);

        // Mengembalikan response atau redirect ke halaman sukses
        return redirect()->route('report.create')->with('success', 'Pengaduan berhasil!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $reports = Report::with(['comments'])->findOrFail($id);
        $reports->increment('viewers'); // Tambah jumlah views setiap kali halaman dikunjungi
        return view('guest.report.detail', compact('reports'));
    }

    public function voting(Request $request, $id)
    {
        $reports = Report::findOrFail($id);

        // Ambil data voting dari kolom
        $voting = json_decode($reports->voting, true);
    
        // ID user saat ini
        $userId = auth()->id();
    
        if (in_array($userId, $voting)) {
            // Jika user sudah voting, hapus dari daftar
            $voting = array_diff($voting, [$userId]);
            $message = 'Voting dihapus!';
        } else {
            // Jika user belum voting, tambahkan ke daftar
            $voting[] = $userId;
            $message = 'Voting berhasil!';
        }
    
        // Simpan kembali ke database
        $reports->voting = json_encode($voting);
        $reports->save();
    
        return redirect()->back()->with('success', $message);
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|max:500',
        ]);

        Comment::create([
            'report_id' => $id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
