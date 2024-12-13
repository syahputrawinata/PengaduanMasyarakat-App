@extends('layouts.template')
@section('content')
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Keluhan Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: #ff7f00;
            padding: 30px;
            color: white;
            border-radius: 5%;
        }
        .form-container h1 {
            font-weight: bold;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container .form-control {
            margin-bottom: 15px;
        }
        .form-container .btn {
            background-color: #004d40;
            color: white;
        }
        .info-box {
            background-color: #fff3e0;
            color: #004d40;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }
        .info-box p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 form-container">
        @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
            <h1>Keluhan</h1>
            <form action="{{route('report.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="province">Provinsi*</label>
                    <select class="form-select" id="province" name="province">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="regency">Kota/Kabupaten*</label>
                    <select class="form-select" id="regency" name="regency">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="subdistrict">Kecamatan*</label>
                    <select class="form-select" id="subdistrict" name="subdistrict">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="village">Kelurahan*</label>
                    <select class="form-select" id="village" name="village">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">Type*</label>
                    <select class="form-select" id="type" name="type">
                        <option value="KEJAHATAN">Kejahatan</option>
                        <option value="PEMBANGUNAN">Pembangunan</option>
                        <option value="SOSIAL">Sosial</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Detail Keluhan*</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image">Gambar Pendukung*</label>
                    <input class="form-control" id="image" name="image" type="file"/>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" id="statement" name="statement" type="checkbox" value="1"/>
                    <label class="form-check-label" for="statement">Laporan yang disampaikan sesuai dengan kebenaran.</label>
                </div>
                <button class="btn btn-succees" type="submit">Kirim</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h3>Panduan Mengisi Form</h3>
                <p>- Pastikan semua data yang dimasukkan benar.</p>
                <p>- File gambar pendukung maksimal 2MB.</p>
                <p>- Klik tombol "Kirim" untuk mengirim laporan Anda.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('regency');
        const districtSelect = document.getElementById('subdistrict');
        const villageSelect = document.getElementById('village');

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

        // Load cities based on selected province
        provinceSelect.addEventListener('change', function () {
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

            if (this.value) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kota_kabupaten.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.nama;
                            citySelect.appendChild(option);
                        });
                    });
            }
        });

        // Load districts based on selected city
        citySelect.addEventListener('change', function () {
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

            if (this.value) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kecamatan.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.nama;
                            districtSelect.appendChild(option);
                        });
                    });
            }
        });

        // Load villages based on selected district
        districtSelect.addEventListener('change', function () {
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

            if (this.value) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kelurahan.forEach(village => {
                            const option = document.createElement('option');
                            option.value = village.id;
                            option.textContent = village.nama;
                            villageSelect.appendChild(option);
                        });
                    });
            }
        });
    });
</script>

</body>
</html>
@endsection
