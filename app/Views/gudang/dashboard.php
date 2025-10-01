<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Gudang</h2>
            <div>
                <a href="/gudang/bahanbaku" class="btn btn-primary">Manajemen Bahan Baku</a>
                <a href="/auth/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <div class="alert alert-success">
            Selamat datang, **<?= session()->get('name') ?>**! Anda telah login sebagai **<?= session()->get('role') ?>**.
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>