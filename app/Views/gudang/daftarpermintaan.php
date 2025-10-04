<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Permintaan Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body> 
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Permintaan Bahan Baku</h2>
            <a href="/gudang/dashboard" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
        <hr>
        
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tgl Permintaan</th>
                    <th>Pemohon</th>
                    <th>Tgl Masak</th>
                    <th>Menu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($permintaan)): ?>
                    <?php foreach ($permintaan as $item): ?>
                        <tr>
                            <td><?= date('d M Y, H:i', strtotime($item['created_at'])) ?></td>
                            <td><?= esc($item['pemohon_nama']) ?></td>
                            <td><?= date('d M Y', strtotime($item['tgl_masak'])) ?></td>
                            <td><?= esc($item['menu_makan']) ?></td>
                            <td>
                                <?php
                                    $status = esc($item['status']);
                                    $badgeClass = 'bg-secondary';
                                    if ($status == 'menunggu') $badgeClass = 'bg-warning text-dark';
                                    if ($status == 'disetujui') $badgeClass = 'bg-success';
                                    if ($status == 'ditolak') $badgeClass = 'bg-danger';
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                            </td>
                            <td>
                                <a href="/gudang/permintaan/detail/<?= $item['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye-fill"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">Belum ada permintaan yang masuk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>