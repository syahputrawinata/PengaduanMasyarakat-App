@extends('layouts.template')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Progress Page
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .status-badge {
            background-color: #28a745;
            color: white;
            padding: 0.25em 0.5em;
            border-radius: 0.25em;
        }

        .btn-custom {
            background-color: #2d6a4f;
            color: white;
        }

        .btn-custom:hover {
            background-color: #1b4332;
            color: white;
        }

        .btn-secondary-custom {
            background-color: #e9ecef;
            color: #2d6a4f;
        }

        .btn-secondary-custom:hover {
            background-color: #ced4da;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>
                        {{ $reports->user->email }}
                    </h5>
                    <a href="{{ route('staff.index') }}" class="btn btn-custom">
                        Kembali
                    </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>
                        {{ \Carbon\Carbon::parse($reports->created_at)->format('d F Y') }}
                        <strong>
                            Status tanggapan:
                        </strong>
                        <span class="status-badge">
                            {{ $reports->response->response_status ?? 'Belum Ada Tanggapan' }}
                        </span>
                    </span>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    {{ $reports->province_name }}, {{ $reports->regency_name }}, {{ $reports->subdistrict_name }}, {{ $reports->village_name }}
                                </h6>
                                <p class="card-text">
                                    {{ $reports->description }}
                                </p>
                                <img alt="Laporan terkait lokasi" class="img-fluid" src="{{ asset('storage/' . $reports->image) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            @if ($reports->response && $reports->response->responseProgress)
                            @foreach ($reports->response->responseProgress as $progress)
                            <span>
                            <a 
                                class="text-warning" href="#" data-bs-toggle="modal" data-bs-target="#deleteProgressModal" data-id="{{ $progress->id }}"> {{ \Carbon\Carbon::parse($progress->created_at)->format('d F Y') }}
                            </a>
                                : {{ str_replace('"', '', $progress->histories) }}
                            </span>
                            @endforeach
                            @else
                            <span class="text-muted">
                                Belum ada progres untuk laporan ini.
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    @if ($reports->response && $reports->response->response_status !== 'completed')
                    <form action="{{ route('staff.completeResponse', ['id' => $reports->response->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-custom me-2">Nyatakan Selesai</button>
                    </form>
                    @endif

                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-secondary-custom" data-bs-toggle="modal" data-bs-target="#progressModal">
                        Tambah Progres
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding progress -->
    <div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="progressModalLabel">Tambah Progres</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('staff.createProgress',  ['responseId' => $reports->response->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="histories" class="form-label">Detail Progres</label>
                            <textarea class="form-control" id="histories" name="histories" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--modal hapus--}}
    <div class="modal fade" id="deleteProgressModal" tabindex="-1" aria-labelledby="deleteProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProgressModalLabel">Hapus Progres</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('staff.deleteProgress', ['id' => $progress->id]) }}" id="deleteProgressForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Yakin menghapus data progress yang anda buat pada tanggal <strong>{{ \Carbon\Carbon::parse($progress->created_at)->format('d F Y') }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection