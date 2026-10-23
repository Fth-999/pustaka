<?php
require 'koneksi.php';
$judul_halaman = 'Input Buku';
$menu_aktif    = 'buku';
require 'layout/header.php';
?>

<h1 class="mb-3">Input Data Buku</h1>

<form action="proses.php" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="kode_buku"
                   name="kode_buku" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="judul"
                   name="judul" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="pengarang"
                   name="pengarang">
        </div>
    </div>
    <div class="row mb-3">
        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="penerbit"
                   name="penerbit">
        </div>
    </div>
    <div class="row mb-3">
        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
        <div class="col-sm-4">
            <input type="number" class="form-control" id="tahun_terbit"
                   name="tahun_terbit">
        </div>
    </div>
    <div class="row mb-3">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-4">
            <input type="number" class="form-control" id="stok"
                   name="stok" value="0">
        </div>
    </div>
    <div class="row mb-3">
        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
        <div class="col-sm-4">
            <input type="file" accept="image/*" class="form-control"
                   id="sampul" name="sampul">
        </div>
    </div>

    <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
    <a href="buku.php" class="btn btn-secondary">Kembali</a>
</form>

<?php require 'layout/footer.php'; ?>
