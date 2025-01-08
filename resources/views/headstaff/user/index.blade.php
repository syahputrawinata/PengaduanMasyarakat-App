@extends('layouts.template')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .table-container, .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .btn-reset {
            background-color: #0d6efd;
            color: white;
        }
        .btn-reset:hover {
            background-color: #0b5ed7;
            color: white;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }
        .btn-hapus:hover {
            background-color: #bb2d3b;
            color: white;
        }
        .btn-buat {
            background-color: #215734;
            color: white;
        }
        .btn-buat:hover {
            background-color: #19462a;
            color: #ffffff;
        }
        h5 {
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Tabel Akun Staff -->
            <div class="col-md-7">
                <div class="table-container">
                    <h5>Akun Staff Daerah {{ $staffProvince->province_name }}</h5>
                    @if (Session::get('reset'))
                        <div class="alert alert-success">{{Session::get('reset') }}</div>
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success">{{Session::get('success') }}</div>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{{Session::get('error') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th>Email</th>
                                <th style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><a href="mailto:{{ $user->email }}" class="text-primary text-decoration-none text-black">{{ $user->email }}</a></td>
                                <td>
                                <form action="{{ route('user.resetPassword', ['userId' => $user->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button class="btn btn-sm btn-reset" type="submit">Reset</button>
                                </form>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-hapus" type="submit">Hapus</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Input Akun Staff -->
            <div class="col-md-5">
                <div class="form-container">
                    <h5>Buat Akun Staff</h5>
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Sandi</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
                        </div>
                        <button type="submit" class="btn btn-buat">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper + Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection