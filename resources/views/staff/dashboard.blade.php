@extends('layouts.template')

@section('content')
<html>
<head>
    <title>Table Example</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
        .btn-export {
            background-color: #2d6a4f;
            color: white;
        }
        .btn-export:hover {
            background-color: #1b4332;
        }
        .btn-action {
            background-color: #e9ecef;
            color: #495057;
        }
        .btn-action:hover {
            background-color: #ced4da;
        }
        .fab-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <div class="d-flex justify-content-end mb-3">
            <div class="dropdown">
                <button class="btn btn-export dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Export (.xlsx)
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#">Seluruh Data</a></li>
                    <li><a class="dropdown-item" href="#">Berdasarkan Tanggal</a></li>
                </ul>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar &amp; Pengirim</th>
                    <th>Lokasi &amp; Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Vote</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img alt="Profile picture" height="40" src="{{ asset('storage/' . $report->image) }}" width="40"/>
                                <span class="ms-2">{{ $report->user->email }}</span>
                            </div>
                        </td>
                        <td>
                            <div>{{ $report->province_name }}, {{ $report->regency_name }}, {{ $report->subdistrict_name }}, {{ $report->village_name }}</div>
                            <div>{{ $report->created_at->format('d M Y') }}</div>
                        </td>
                        <td>{{ $report->description }}</td>
                        <td>{{ count(json_decode($report->voting, true)) }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-action dropdown-toggle" type="button" id="actionDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="actionDropdown1">
                                    <li><a class="dropdown-item" href="#">Tolak</a></li>
                                    <li><a class="dropdown-item" href="#">Proses Penyesuaian/perbaikan</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{-- <div>
            {{ $reports->links() }}
        </div> --}}
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
