@extends('layouts.template')
@section('content')
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Halaman Report 
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ff7f00;
        }

        .alert{
            background-color: white;
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

        .fa-heart {
        font-size: 18px;
        color: gray;
        transition: color 0.3s ease;
        }

        .fa-heart.liked {
            color: red; /* Warna love ketika di-click */
        }

        .like-button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        @if(Session::get('success'))
        <div class="alert alert-Success" background-color="white">{{ Session::get('success') }}</div>
        @endif
        <form class="input-gropu mb-3 d-flex" action="{{ route('report.index')}}" method="GET">
            <select class="form-select mr-3" id="province" name="filter_province" value="{{ request('filter_province')}}">
                <option>Pilih</option>
            </select>
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
        <div class="row">
            <div class="col-md-8">
            @foreach($reports as $report)
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="{{ asset('storage/' . $report->image) }}" alt="Image" class="img-fluid rounded-start" height="200" width="300" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body position-relative">
                            <h5 class="card-title"><a href="{{route('report.show', $report->id)}}" class="text-black">{{ $report->description }}</a></h5>
                            <p class="card-text">
                                <i class="fas fa-eye"></i> {{$report->viewers}}
                                <i class="fas fa-heart"></i> {{ count(json_decode($report->voting, true)) }}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">{{ $report->user->email }}</small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">{{ $report->created_at->diffForHumans() }}</small>
                            </p>
                            <form action="{{ route('report.voting', $report->id) }}" method="POST" id="likeForm-{{ $report->id }}" class="position-absolute top-0 end-0">
                                @csrf
                                <button type="submit" class="like-button" style="background: none; border: none; cursor: pointer;">
                                    <i 
                                        class="fa fa-heart {{ in_array(auth()->id(), json_decode($report->voting, true)) ? 'liked' : '' }}" 
                                        id="likeIcon-{{ $report->id }}"
                                    ></i><p>vote</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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