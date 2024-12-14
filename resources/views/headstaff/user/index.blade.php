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
        }
        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }
        .btn-hapus:hover {
            background-color: #bb2d3b;
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
                    <h5>Akun Staff Daerah JAWA BARAT</h5>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th>Email</th>
                                <th style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="mailto:staff_jabar@gmail.com" class="text-primary text-decoration-none text-black">staff_jabar@gmail.com</a></td>
                                <td>
                                    <button class="btn btn-sm btn-reset">Reset</button>
                                    <button class="btn btn-sm btn-hapus">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="mailto:hstaff_jabar@gmail.com" class="text-primary text-decoration-none text-black">hstaff_jabar@gmail.com</a></td>
                                <td>
                                    <button class="btn btn-sm btn-reset">Reset</button>
                                    <button class="btn btn-sm btn-hapus">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Input Akun Staff -->
            <div class="col-md-5">
                <div class="form-container">
                    <h5>Buat Akun Staff</h5>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukan Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="sandi" class="form-label">Sandi</label>
                            <input type="password" class="form-control" id="sandi" placeholder="Masukan Password" required>
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
