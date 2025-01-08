<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // Sesuaikan model Anda
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\pdf as PDF;

class ExportController extends Controller
{
    // Export Semua Data
    public function exportAllReports()
    {
        return Excel::download(new ReportExport(), 'semua_data_pengaduan.xlsx');
    }

    // Export Berdasarkan Filter Tanggal
    public function exportFilteredReports(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        return Excel::download(
            new ReportExport($request->start_date, $request->end_date),
            'filtered_reports.xlsx');
    }
}
