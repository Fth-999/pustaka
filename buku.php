<?php
require 'koneksi.php';
$judul_halaman = 'Data Buku';
$menu_aktif    = 'buku';
require 'layout/header.php';

$hasil = $koneksi->query("SELECT * FROM buku ORDER BY id_buku DESC");
$no = 1;
?>

<h1 class="mb-3">Data Buku</h1>
<a class="btn btn-success mb-3" href="form.php">+ Input Buku</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Sampul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['kode_buku']) ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['pengarang']) ?></td>
                <td><?= htmlspecialchars($row['penerbit']) ?></td>
                <td><?= $row['tahun_terbit'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <?php if (!empty($row['sampul'])) : ?>
                        <img src="sampul/<?= htmlspecialchars($row['sampul']) ?>"
                             width="80" alt="Sampul">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $row['id_buku'] ?>"
                       class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id_buku'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>

        <?php if ($hasil->num_rows == 0) : ?>
            <tr>
                <td colspan="9" class="text-center">Belum ada data buku.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require 'layout/footer.php'; ?>
