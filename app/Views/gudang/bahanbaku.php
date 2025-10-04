<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
    <div class="container mt-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Bahan Baku</h2>
            <div>
                <a href="/gudang/bahanbaku/tambah" class="btn btn-success">Tambah Bahan Baku</a>
                <a href="/gudang/dashboard" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>
        <hr>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th><th>Kategori</th><th>Jumlah</th><th>Satuan</th>
                    <th>Tgl Masuk</th><th>Tgl Kadaluarsa</th><th>Status</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bahan_baku)): ?>
                    <?php foreach ($bahan_baku as $item): ?>
                        <tr>
                            <td><?= esc($item['nama']) ?></td>
                            <td><?= esc($item['kategori']) ?></td>
                            <td><?= esc($item['jumlah']) ?></td>
                            <td><?= esc($item['satuan']) ?></td>
                            <td><?= esc($item['tanggal_masuk']) ?></td>
                            <td><?= esc($item['tanggal_kadaluarsa']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= esc($item['status']) ?></span></td>
                            <td>
                                <a href="/gudang/bahanbaku/edit/<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                                    Update Stok
                                </a>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">Belum ada data bahan baku.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>