<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,.05);
        }
        .card-icon {
            font-size: 3rem;
            opacity: 0.3;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-box-seam"></i> Gudang MBG
            </a>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    Halo, <strong><?= esc(session()->get('name')) ?>!</strong>
                </span>
                <a href="/auth/logout" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        _</div>
    </nav>

    <div class="container mt-4">

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Selamat Datang di Dashboard Gudang</h4>
                <a href="/gudang/bahanbaku" class="btn btn-primary">
                    <i class="bi bi-card-checklist"></i> Buka Manajemen Bahan Baku
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-bg-info">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Bahan Baku</h5>
                            <p class="card-text fs-4 fw-bold">15 Jenis</p> 
                        </div>
                        <i class="bi bi-archive-fill card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-bg-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Segera Kadaluarsa</h5>
                            <p class="card-text fs-4 fw-bold">3 Jenis</p> 
                        </div>
                        <i class="bi bi-alarm-fill card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/gudang/permintaan" class="text-decoration-none">
                    <div class="card text-bg-success">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Permintaan Masuk</h5>
                                <p class="card-text fs-4 fw-bold">Lihat & Proses</p>
                            </div>
                            <i class="bi bi-journal-text card-icon"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>