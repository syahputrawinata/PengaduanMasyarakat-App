@extends('layouts.template')

@section('content')
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .card-header {
            background-color: #f57c00;
            color: white;
            font-weight: bold;
            padding: 12px 16px;
            border-bottom: 2px solid #e65100;
        }

        .status-done {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
        }

        .status-pending {
            background-color: #ffc107;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
        }

        .nav-tabs .nav-link.active {
            background-color: #fff3e0;
            border-color: #f57c00;
            color: #f57c00;
            font-weight: bold;
        }

        .nav-tabs .nav-link {
            color: #f57c00;
            border: 1px solid #f57c00;
            margin-right: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: #ffe0b2;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }

        .card-body {
            background-color: #fff;
            padding: 20px;
        }

        .tab-content img {
            border-radius: 10px;
        }

        .btn-link {
            color: white;
        }

        .btn-link:hover {
            color: #ffe0b2;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            font-size: 0.85rem;
            color: white;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4 text-center text-uppercase text-secondary">Daftar Pengaduan</h3>

        <!-- Iterasi Pengaduan -->
        @foreach ($reports as $report)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-calendar-alt"></i> Pengaduan {{ $report->created_at->format('d F Y') }}</span>
                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $report->id }}" aria-expanded="false" aria-controls="collapse{{ $report->id }}">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="collapse" id="collapse{{ $report->id }}">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab{{ $report->id }}" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-tab-{{ $report->id }}" data-bs-toggle="tab" data-bs-target="#data{{ $report->id }}" type="button" role="tab" aria-controls="data" aria-selected="true">
                                <i class="fas fa-info-circle"></i> Data
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gambar-tab-{{ $report->id }}" data-bs-toggle="tab" data-bs-target="#gambar{{ $report->id }}" type="button" role="tab" aria-controls="gambar" aria-selected="false">
                                <i class="fas fa-image"></i> Gambar
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="status-tab-{{ $report->id }}" data-bs-toggle="tab" data-bs-target="#status{{ $report->id }}" type="button" role="tab" aria-controls="status" aria-selected="false">
                                <i class="fas fa-tasks"></i> Status
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent{{ $report->id }}">
                        <div class="tab-pane fade show active" id="data{{ $report->id }}" role="tabpanel" aria-labelledby="data-tab-{{ $report->id }}">
                            <ul class="mt-3">
                                <li><strong>Tipe:</strong> {{ $report->type }}</li>
                                <li><strong>Lokasi:</strong> {{ $report->village_name }}, {{ $report->subdistrict_name }}, {{ $report->regency_name }}, {{ $report->province_name }}</li>
                                <li><strong>Deskripsi:</strong> {{ $report->description }}</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="gambar{{ $report->id }}" role="tabpanel" aria-labelledby="gambar-tab-{{ $report->id }}">
                            <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid mt-3" alt="Gambar Pengaduan">
                        </div>
                        <div class="tab-pane fade" id="status{{ $report->id }}" role="tabpanel" aria-labelledby="status-tab-{{ $report->id }}">
                            @if ($report->response && $report->response->response_status)
                                <p class="mt-3">Pengaduan telah ditanggapi, dengan status: <span class="status-done">{{ $report->response->response_status }}</span></p>
                                @foreach ($reports as $report)
                                <p><i class="fas fa-circle" style="color: gray;"></i> {{ $report->created_at->format('d F Y') }}: {{ str_replace('"', '', $report->histories) }}</p>
                                @endforeach
                            @else
                                <p class="mt-3">Pengaduan belum diproses.</p>
                                <form action="{{ route('report.deleteMonitoring', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
