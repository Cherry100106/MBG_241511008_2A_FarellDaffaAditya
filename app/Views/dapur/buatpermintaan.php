<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Permintaan Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Permintaan Bahan Baku</h2>
        <a href="/dapur/dashboard" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <form action="/dapur/permintaan/store" method="post">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="tgl_masak" class="form-label">Tanggal Masak</label>
                    <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" required>
                </div>
                <div class="col-md-4">
                    <label for="menu_makan" class="form-label">Menu yang Akan Dibuat</label>
                    <input type="text" class="form-control" id="menu_makan" name="menu_makan" required>
                </div>
                <div class="col-md-4">
                    <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
                    <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" required>
                </div>
            </div>

            <hr>
            <h5>Daftar Bahan yang Diminta</h5>
            <div id="bahan-list">
                </div>

            <button type="button" id="add-bahan" class="btn btn-success mt-2">Tambah Bahan</button>
            <hr>
            <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bahanList = document.getElementById('bahan-list');
            const addBahanBtn = document.getElementById('add-bahan');

            const bahanOptions = <?= json_encode($bahan_tersedia) ?>;

            function createBahanRow() {
                const row = document.createElement('div');
                row.className = 'row mb-2 align-items-center';

                let optionsHtml = '<option value="">Pilih Bahan</option>';
                bahanOptions.forEach(bahan => {
                    optionsHtml += `<option value="${bahan.id}">${bahan.nama} (${bahan.satuan})</option>`;
                });

                row.innerHTML = `
                    <div class="col-md-6">
                        <select class="form-select" name="bahan_id[]" required>
                            ${optionsHtml}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="jumlah_diminta[]" placeholder="Jumlah" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-bahan">Hapus</button>
                    </div>
                `;
                bahanList.appendChild(row);
            }

            addBahanBtn.addEventListener('click', createBahanRow);

            bahanList.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-bahan')) {
                    e.target.closest('.row').remove();
                }
            });

            createBahanRow();
        });
    </script>
</body>
</html>