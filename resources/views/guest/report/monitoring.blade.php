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
        .card-header {
            background-color: #f57c00;
            color: white;
        }

        .status-done {
            background-color: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .nav-tabs .nav-link.active {
            border-color: #f57c00 #f57c00 #fff;
            color: #f57c00;
        }

        .nav-tabs .nav-link {
            color: #f57c00;
        }

        .dropdown-menu {
            z-index: 1050;  /* pastikan dropdown berada di atas elemen lain */
        }

        /* Optional for the active tab indicator */
        .nav-tabs .nav-link {
            transition: background-color 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: #fff3e0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Pengaduan 06 Desember 2024</span>
                <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="collapse" id="collapseExample1">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Data</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gambar-tab" data-bs-toggle="tab" data-bs-target="#gambar" type="button" role="tab" aria-controls="gambar" aria-selected="false">Gambar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="false">Status</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                            <p>Pengaduan telah ditanggapi, dengan status : <span class="status-done">DONE</span></p>
                            <p><i class="fas fa-circle" style="color: gray;"></i> 06 Desember 2024 : peralatan sedang dipersiapkan</p>
                        </div>
                        <div class="tab-pane fade" id="gambar" role="tabpanel" aria-labelledby="gambar-tab">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="Placeholder image for Gambar section">
                        </div>
                        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                            <p>Status pengaduan: <span class="status-done">DONE</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Pengaduan 07 Desember 2024</span>
                <button class="btn btn-link text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="collapse" id="collapseExample2">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-tab2" data-bs-toggle="tab" data-bs-target="#data2" type="button" role="tab" aria-controls="data2" aria-selected="true">Data</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gambar-tab2" data-bs-toggle="tab" data-bs-target="#gambar2" type="button" role="tab" aria-controls="gambar2" aria-selected="false">Gambar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="status-tab2" data-bs-toggle="tab" data-bs-target="#status2" type="button" role="tab" aria-controls="status2" aria-selected="false">Status</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="data2" role="tabpanel" aria-labelledby="data-tab2">
                            <ul>
                                <li>Tipe : SOSIAL</li>
                                <li>Lokasi : TAPOS, CIBEDUG, KABUPATEN BOGOR, JAWA BARAT</li>
                                <li>Deskripsi : Kesenjangan sosial adalah masalah sosial yang akan banyak memiliki dampak negatif. Kesenjangan sosial adalah suatu kondisi dimana tidak adanya keseimbangan antara masyarakat. Kesenjangan sosial sering sekali dikaitkan dengan adanya perbedaan yang sangat jelas terlihat di antara masyarakat.</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="gambar2" role="tabpanel" aria-labelledby="gambar-tab2">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="Placeholder image for Gambar section">
                        </div>
                        <div class="tab-pane fade" id="status2" role="tabpanel" aria-labelledby="status-tab2">
                            <p>Status pengaduan: <span class="status-done">PENDING</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
