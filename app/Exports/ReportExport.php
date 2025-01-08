<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Report::with(['user', 'response'])
            ->select('id', 'user_id', 'description', 'voting', 'created_at', 'image', 'province', 'regency')
            ->when($this->startDate && $this->endDate, function ($q) {
                $q->whereBetween('created_at', [$this->startDate, $this->endDate]);
            });

        return $query->get();
    }

    public function headings(): array
    {
        return [
            '#', 'Email Pelapor', 'Dilaporkan Pada Tanggal', 'Deskripsi Pengaduan',
            'URL Gambar', 'Lokasi', 'Jumlah Voting', 'Status Pengaduan',
            'Progres Tanggapan', 'Staff Terkait'
        ];
    }

    public function map($report): array
    {
        // Mengambil progres tanggapan dengan aman
        $progress = optional(optional($report->response)->responseProgress)->histories['progress'] ?? 'N/A';
        $staffEmail = optional(optional($report->response)->staff)->email ?? '';
    
        return [
            $report->id,
            optional($report->user)->email ?? 'N/A',
            $report->created_at ? $report->created_at->format('d F Y') : 'N/A',
            $report->description ?? 'N/A',
            $report->image ?? 'N/A',
            "{$report->province}, {$report->regency}",
            $report->voting ?? 0,
            $report->response ? $report->response->response_status : 'Belum Ditanggapi',
            $progress,
            $staffEmail,
        ];
    }
}
