<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login atau Register</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .left-section {
            background-color: #f97316;
            color: white;
            padding: 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-section {
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .right-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }
        .floating-icons {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .floating-icons a {
            background-color: #0f766e;
            color: white;
            padding: 15px;
            border-radius: 50%;
            text-align: center;
            font-size: 20px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-custom {
            background-color: #0f766e;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
        }
        .form-control {
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            padding: 10px;
        }
        @media (min-width: 768px) {
            .container-fluid {
                flex-direction: row;
            }
            .floating-icons {
                display: flex;
                flex-direction: column-reverse;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="left-section">
        <h1>Login atau Register</h1>
        <form action="{{ route('login.auth') }}" method="POST">
          @csrf
        @if(Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @if(Session::get('logout'))
                <div class="alert alert-danger">{{ Session::get('logout') }}</div>
        @endif
        @if(Session::get('failregis'))
                <div class="alert alert-danger">{{ Session::get('failregis') }}</div>
        @endif
        @if(Session::get('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
            <input type="email" class="form-control" placeholder="Email" name="email" required />
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <!-- <input type="password" class="form-control" placeholder="Konfirmasi Password (untuk Register)" name="password_confirmation" /> -->
                <button type="submit" name="register" class="btn btn-link text-white">Register</button>
                <button type="submit" name="login" class="btn-custom">Login</button>
        </form>
    </div>
    <div class="right-section">
        <img alt="Aerial view of a city street with cars and trees" src="https://storage.googleapis.com/a1aa/image/vtMeEJwPOUySPy8UGnfZbEVzxyxrfFNfZKi6nO0FQwjWN2hPB.jpg" />
        <div class="floating-icons">
            <a href="#">
                <i class="fas fa-user"></i>
            </a>
            <a href="#">
                <i class="fas fa-exclamation"></i>
            </a>
            <a href="#">
                <i class="fas fa-pen"></i>
            </a>
        </div>
    </div>
</div>
</body>
</html>
