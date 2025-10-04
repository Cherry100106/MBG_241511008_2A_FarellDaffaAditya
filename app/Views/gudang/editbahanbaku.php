<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Stok Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Stok untuk: <?= esc($bahan['nama']) ?></h2>
        <a href="/gudang/bahanbaku" class="btn btn-secondary mb-3">Batal dan Kembali</a>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/gudang/bahanbaku/update" method="post">
            
            <input type="hidden" name="id" value="<?= esc($bahan['id']) ?>">
            
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Stok Baru</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= esc($bahan['jumlah']) ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>