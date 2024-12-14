<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Report;
use App\Models\StaffProvince;
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
}
