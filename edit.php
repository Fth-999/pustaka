<?php
require 'koneksi.php';

// Ambil data buku berdasarkan id (prepared statement)
$id   = $_GET['id'] ?? 0;
$stmt = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

// Jika data tidak ditemukan, kembali ke daftar buku
if (!$row) {
    redirect('buku.php', 'danger', 'Data buku tidak ditemukan.');
}

$judul_halaman = 'Edit Buku';
$menu_aktif    = 'buku';
require 'layout/header.php';
?>

<h1 class="mb-3">Edit Data Buku</h1>

<form action="proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">

    <div class="row mb-3">
        <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="kode_buku" name="kode_buku"
                   value="<?= htmlspecialchars($row['kode_buku']) ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="judul" name="judul"
                   value="<?= htmlspecialchars($row['judul']) ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="pengarang" name="pengarang"
                   value="<?= htmlspecialchars($row['pengarang']) ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="penerbit" name="penerbit"
                   value="<?= htmlspecialchars($row['penerbit']) ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
        <div class="col-sm-4">
            <input type="number" class="form-control" id="tahun_terbit"
                   name="tahun_terbit" value="<?= $row['tahun_terbit'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-4">
            <input type="number" class="form-control" id="stok" name="stok"
                   value="<?= $row['stok'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
        <div class="col-sm-4">
            <?php if (!empty($row['sampul'])) : ?>
                <img src="sampul/<?= htmlspecialchars($row['sampul']) ?>"
                     width="100" class="mb-2 d-block" alt="Sampul">
            <?php endif; ?>
            <input type="file" accept="image/*" class="form-control"
                   id="sampul" name="sampul">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti sampul.</small>
        </div>
    </div>

    <input type="submit" value="Simpan Perubahan" name="update" class="btn btn-primary">
    <a href="buku.php" class="btn btn-secondary">Kembali</a>
</form>

<?php require 'layout/footer.php'; ?>
