<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dapur</title>
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
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-egg-fried"></i> Dapur MBG
            </a>
            <div class="d-flex">
                 <span class="navbar-text me-3">
                    Halo, <strong><?= esc(session()->get('name')) ?>!</strong>
                </span>
                <a href="/auth/logout" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Dashboard Petugas Dapur</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">Daftar Bahan Baku Tersedia</h5>
                    <a href="/dapur/permintaan" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Buat Permintaan Baru
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tgl Kadaluarsa</th>
                                <th>Status</th>
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
                                        <td><?= date('d M Y', strtotime(esc($item['tanggal_kadaluarsa']))) ?></td>
                                        <td>
                                            <?php
                                                $status = esc($item['status']);
                                                $badgeClass = 'bg-secondary';
                                                if ($status == 'tersedia') {
                                                    $badgeClass = 'bg-success';
                                                } elseif ($status == 'segera_kadaluarsa') {
                                                    $badgeClass = 'bg-warning text-dark';
                                                } elseif ($status == 'habis') {
                                                    $badgeClass = 'bg-danger';
                                                }
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= ucfirst(str_replace('_', ' ', $status)) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data bahan baku yang tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>