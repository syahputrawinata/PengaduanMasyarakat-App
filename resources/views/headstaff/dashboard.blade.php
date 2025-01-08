@extends('layouts.template')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Pengaduan dan Tanggapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .chart-container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h3>Jumlah Pengaduan dan Tanggapan terhadap Pengaduan <br> <strong>{{ $staffProvince->province_name }}</strong></h3>
        <canvas id="barChart"></canvas>
    </div>

    <script>
        // Data dari Controller
        const complaintsCount = {{ $complaintsCount }};
        const responsesCount = {{ $responsesCount }};

        // Render Chart
        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pengaduan', 'Tanggapan'],
                datasets: [{
                    label: 'Total Data',
                    data: [complaintsCount, responsesCount],
                    backgroundColor: [
                        'rgba(173, 216, 230, 0.5)', // Light Blue
                        'rgba(255, 182, 193, 0.5)'  // Light Pink
                    ],
                    borderColor: [
                        'rgba(173, 216, 230, 1)',
                        'rgba(255, 182, 193, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
@endsection
