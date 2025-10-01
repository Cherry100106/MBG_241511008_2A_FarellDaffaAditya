<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dapur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success">
            Selamat datang, Petugas Dapur!
        </div>
        <h2>Dashboard Dapur</h2>
        <p>Anda telah login sebagai Petugas**<?= session()->get('role') ?>**.</p>
        <a href="/auth/logout" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>