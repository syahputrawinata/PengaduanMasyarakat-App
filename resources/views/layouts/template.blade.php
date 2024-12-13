<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 10px 25px;
        }
        .sidebar a {
            background-color: #0f766e;
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
            font-size: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, background-color 0.2s;
        }
        .sidebar a:hover {
            transform: scale(1.1);
            background-color: #0d5e56;
        }
        .content {
            margin-top: 20px;
            padding: 20px;
        }
    </style>
    <title>Sidebar Template</title>
</head>
<body>

<div class="sidebar">
    <a href="{{route('report.index')}}" title="User">
        <i class="fas fa-home"></i>
    </a>
    <a href="#" title="Exclamation">
        <i class="fas fa-exclamation"></i>
    </a>
    <a href="{{route('report.create')}}" title="Pen">
        <i class="fas fa-pen"></i>
    </a>
    <a href="{{route('logout')}}" title="Logout">
    <i class="fas fa-running"></i>
    </a>
</div>

<div class="container mt-5">
        @yield('content')
</div>

</body>
</html>
