<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Permintaan Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body> 
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Permintaan</h4>
                <a href="/gudang/permintaan" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Permintaan</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Pemohon:</strong> <?= esc($permintaan['pemohon_nama']) ?></li>
                            <li class="list-group-item"><strong>Tanggal Masak:</strong> <?= date('d M Y', strtotime($permintaan['tgl_masak'])) ?></li>
                            <li class="list-group-item"><strong>Menu:</strong> <?= esc($permintaan['menu_makan']) ?></li>
                            <li class="list-group-item"><strong>Jumlah Porsi:</strong> <?= esc($permintaan['jumlah_porsi']) ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Status Permintaan</h5>
                        <?php
                            $status = esc($permintaan['status']);
                            $badgeClass = 'bg-secondary';
                            if ($status == 'menunggu') $badgeClass = 'bg-warning text-dark';
                            if ($status == 'disetujui') $badgeClass = 'bg-success';
                            if ($status == 'ditolak') $badgeClass = 'bg-danger';
                        ?>
                        <span class="badge <?= $badgeClass ?> fs-4"><?= ucfirst($status) ?></span>
                    </div>
                </div>

                <h5>Bahan Baku yang Diminta</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Jumlah Diminta</th>
                            <th>Stok Gudang</th>
                            <th>Status Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail_bahan as $item): ?>
                            <tr>
                                <td><?= esc($item['nama_bahan']) ?></td>
                                <td><?= esc($item['jumlah_diminta']) ?> <?= esc($item['satuan']) ?></td>
                                <td><?= esc($item['stok_gudang']) ?> <?= esc($item['satuan']) ?></td>
                                <td>
                                    <?php if ($item['stok_gudang'] >= $item['jumlah_diminta']): ?>
                                        <span class="badge bg-success">Cukup</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Kurang</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <?php if ($permintaan['status'] == 'menunggu'): ?>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <form action="/gudang/permintaan/tolak" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menolak permintaan ini?');">
                        <input type="hidden" name="permintaan_id" value="<?= $permintaan['id'] ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i> Tolak Permintaan
                        </button>
                    </form>
                    <form action="/gudang/permintaan/setujui" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui permintaan ini? Stok akan otomatis dikurangi.');">
                        <input type="hidden" name="permintaan_id" value="<?= $permintaan['id'] ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Setujui Permintaan
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
