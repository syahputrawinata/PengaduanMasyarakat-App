@extends('layouts.template')
@section('content')
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Complaint Page
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ff7f00;
        }

        .card {
            margin-bottom: 20px;
        }

        .info-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }

        .info-box h5 {
            margin-bottom: 15px;
        }

        .info-box ul {
            padding-left: 20px;
        }

        .info-box ul li {
            margin-bottom: 10px;
        }

        .fab-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .fab-buttons .btn {
            margin-bottom: 10px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fab-buttons .btn i {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        @if(Session::get('success'))
        <div class="alert alert-Success">{{ Session::get('success') }}</div>
        @endif
        <div class="input-gropu mb-3 d-flex">
            <select class="form-select mr-3" id="province">
                <option>Pilih</option>
            </select>
            <button class="btn btn-secondary" type="button">Cari</button>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img alt="Image of road construction with heavy machinery" class="img-fluid rounded-start" height="200" src="https://storage.googleapis.com/a1aa/image/6sfHlhq40LznAKI1tXxDn0RIJVDlrwzeKxeM5SIMnhcHhkxnA.jpg" width="300" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Immy Menuturkan Ruas Jalan Sedayu Tergolong K...
                                </h5>
                                <p class="card-text">
                                    <i class="fas fa-eye">
                                    </i>
                                    38
                                    <i class="fas fa-heart">
                                    </i>
                                    1
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        putri@gmail.com
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        13 hours ago
                                    </small>
                                </p>
                                <p class="card-text text-end">
                                    <a class="text-decoration-none" href="#">
                                        <i class="fas fa-heart">
                                        </i>
                                        vote
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img alt="Image of social disparity with slums and high-rise buildings" class="img-fluid rounded-start" height="200" src="https://storage.googleapis.com/a1aa/image/7jToZRt76Sa4JBetrTRVRFiM8v34dK6dp0Wl8ipUKhTRIZ8JA.jpg" width="300" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Kesenjangan Sosial Adalah Masalah Sosial Yang...
                                </h5>
                                <p class="card-text">
                                    <i class="fas fa-eye">
                                    </i>
                                    0
                                    <i class="fas fa-heart">
                                    </i>
                                    0
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        putri@gmail.com
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        2 hours ago
                                    </small>
                                </p>
                                <p class="card-text text-end">
                                    <a class="text-decoration-none" href="#">
                                        <i class="fas fa-heart">
                                        </i>
                                        vote
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <h5>
                        <i class="fas fa-info-circle">
                        </i>
                        Informasi Pembuatan Pengaduan
                    </h5>
                    <ul>
                        <li>
                            Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya,
                        </li>
                        <li>
                            Keseluruhan data pada pengaduan bernilai
                            <strong>
                                BENAR dan DAPAT DIPERTANGGUNG JAWABKAN
                            </strong>
                            ,
                        </li>
                        <li>
                            Seluruh bagian data perlu diisi
                        </li>
                        <li>
                            Pengaduan Anda akan ditanggapi dalam 2x24 Jam,
                        </li>
                        <li>
                            Periksa tanggapan Kami, pada
                            <strong>
                                Dashboard
                            </strong>
                            setelah Anda
                            <strong>
                                Login
                            </strong>
                            ,
                        </li>
                        <li>
                            Pembuatan pengaduan dapat dilakukan pada halaman berikut :
                            <a href="{{route('report.create')}}">
                                Ikuti Tautan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="fab-buttons">
   <button class="btn btn-primary">
    <i class="fas fa-home">
    </i>
   </button>
   <button class="btn btn-info">
    <i class="fas fa-exclamation">
    </i>
   </button>
   <button class="btn btn-success">
    <i class="fas fa-pen">
    </i>
   </button>
  </div> -->
    <script crossorigin="anonymous" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg6tv6WJo4l5hPp2lFyj7l0B2nF5D2U5Q1CTK4zZD" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
    <script crossorigin="anonymous" integrity="sha384-pZjw8f+ua7Kw1TIqj5j6i6b5Ustb5yD1K4rK3zY1Y5Sk7l5T5F5D2U5Q1CTK4zZD" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    </script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('province');

        // Load provinces
        fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
            .then(response => response.json())
            .then(data => {
                data.provinsi.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.nama;
                    provinceSelect.appendChild(option);
                });
            });
    });
</script>

</html>
@endsection