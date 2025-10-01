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
        <hr>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <h3>Daftar Bahan Baku</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bahan_baku)): ?>
                    <?php foreach ($bahan_baku as $item): ?>
                        <tr>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['kategori'] ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td><?= $item['satuan'] ?></td>
                            <td><?= $item['tanggal_masuk'] ?></td>
                            <td><?= $item['tanggal_kadaluarsa'] ?></td>
                            <td><?= $item['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data bahan baku.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>