@extends('layouts.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Pengaduan</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #ff7f00;
        }
        .main-content {
            background-color: #ff7f00;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .info-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }
        .info-card h5 {
            display: flex;
            align-items: center;
        }
        .info-card h5 i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container main-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                        @if ($reports->image)
                            <img src="{{ asset('storage/' . $reports->image) }}" alt="Report Image" class="img-fluid rounded-start">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" alt="Default Image" class="img-fluid rounded-start">
                        @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">
                                    <small class="text-muted">{{ $reports->created_at->diffForHumans() }}</small>
                                </p>
                                <p class="card-text">
                                    {{$reports->description}}
                                </p>
                                <button class="btn btn-warning">{{$reports->type}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <textarea aria-label="With textarea" class="form-control" placeholder="Komentar"></textarea>
                        </div>
                        <button class="btn btn-success mt-2">Buat Komentar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <h5><i class="fas fa-info-circle text-warning"></i> Informasi Pembuatan Pengaduan</h5>
                    <ol>
                        <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya,</li>
                        <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</strong>,</li>
                        <li>Seluruh bagian data perlu diisi</li>
                        <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam,</li>
                        <li>Periksa tanggapan Kami, pada <strong>Dashboard</strong> setelah Anda <strong>Login</strong>,</li>
                        <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut : <a href="#">Ikuti Tautan</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i5q5Y5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i5z5i
@endsection