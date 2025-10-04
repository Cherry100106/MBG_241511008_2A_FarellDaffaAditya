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
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" data-id="<?= $item['id'] ?>" 
                                        data-nama="<?= esc($item['nama']) ?>">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">Belum ada data bahan baku.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus bahan baku <strong id="nama-bahan-hapus"></strong>?</p>
            <p class="text-muted small">Hanya bahan dengan status "kadaluarsa" yang akan berhasil dihapus.</p>
          </div>
          <div class="modal-footer">
            <form id="delete-form" action="/gudang/bahanbaku/delete" method="post">
                <input type="hidden" name="id" id="id-bahan-hapus">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script> 
</body>
</html>