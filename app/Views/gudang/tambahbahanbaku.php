<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
    <div class="container mt-5">
        <h2>Form Tambah Bahan Baku</h2>
        <a href="/gudang/bahan_baku" class="btn btn-secondary mb-3">Kembali ke Daftar</a>

        <form action="/gudang/bahan_baku/store" method="post" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" required>
                </div>
                <div class="col-md-6">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="col-md-6">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Bahan Baku</button>
        </form>
    </div>
</body>
</html>