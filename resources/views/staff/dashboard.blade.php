@extends('layouts.template')

@section('content')
<html>
<head>
    <title>Table Example</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
            color: white;
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
                <li><a class="dropdown-item" href="{{route('export.exportAll')}}">Seluruh Data</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal">Berdasarkan Tanggal</a></li>
                </ul>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar &amp; Pengirim</th>
                    <th>Lokasi &amp; Tanggal</th>
                    <th>Deskripsi</th>
                    <th>
                        Jumlah Vote
                        <a href="{{ route('staff.index', ['sort' => 'votes_desc']) }}" class="text-decoration-none">
                            <i class="bi bi-arrow-down-square"></i>
                        </a>
                        <a href="{{ route('staff.index', ['sort' => 'votes_asc']) }}" class="text-decoration-none ms-2">
                            <i class="bi bi-arrow-up-square"></i>
                        </a>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img alt="Bukti Pengaduan" height="40" src="{{ asset('storage/' . $report->image) }}" width="40" class="img-thumbnail" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $report->id }}"/>
                                <span class="ms-2">{{ $report->user->email }}</span>
                            </div>
                        </td>
                        <td>
                            <div>{{ $report->province_name = strtolower($report->province_name) }}, {{ $report->regency_name }}, {{ $report->subdistrict_name }}, {{ $report->village_name }}</div>
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
                                <li>
                                    <a 
                                        class="dropdown-item text-danger" 
                                        href="#" 
                                        onclick="event.preventDefault(); document.getElementById('reject-form-{{ $report->id }}').submit();">
                                        Tolak
                                    </a>
                                </li>
                                <!-- Tombol Proses Penyesuaian -->
                                <li>
                                    <a 
                                        class="dropdown-item text-primary" 
                                        href="#" 
                                        onclick="event.preventDefault(); document.getElementById('process-form-{{ $report->id }}').submit();">
                                        Proses Penyesuaian/Perbaikan
                                    </a>
                                </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Form Tersembunyi untuk Tolak -->
                    <form 
                        id="reject-form-{{ $report->id }}" 
                        action="{{ route('staff.reject', $report->id) }}" 
                        method="POST" 
                        style="display: none;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="REJECT">
                    </form>

                    <!-- Form Tersembunyi untuk Proses -->
                    <form 
                        id="process-form-{{ $report->id }}" 
                        action="{{ route('staff.createResponse', $report->id) }}" 
                        method="POST" 
                        style="display: none;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ON_PROGRESS">
                    </form>

                    <!-- Modal for Image Detail -->
                    <div class="modal fade" id="imageModal-{{ $report->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-{{ $report->id }}">Detail Gambar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img 
                                        src="{{ asset('storage/' . $report->image) }}" 
                                        class="img-fluid" 
                                        alt="Detail Gambar"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Filter date --}}
                    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filterModalLabel">Filter Export Berdasarkan Tanggal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('export.exportFiltered')}}" method="GET">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Export</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
