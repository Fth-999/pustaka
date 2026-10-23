<?php
require 'koneksi.php';
$judul_halaman = 'Data Anggota';
$menu_aktif    = 'anggota';
require 'layout/header.php';

$hasil = $koneksi->query("SELECT * FROM anggota ORDER BY id_anggota DESC");
$no = 1;
?>

<h1 class="mb-3">Data Anggota</h1>
<a class="btn btn-success mb-3" href="form_anggota.php">+ Input Anggota</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['email'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['no_hp'] ?? '') ?></td>
                <td>
                    <?= $row['dibuat_pada']
                        ? date('d-m-Y H:i', strtotime($row['dibuat_pada']))
                        : '' ?>
                </td>
                <td>
                    <a href="edit_anggota.php?id=<?= $row['id_anggota'] ?>"
                       class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_anggota.php?id=<?= $row['id_anggota'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>

        <?php if ($hasil->num_rows == 0) : ?>
            <tr>
                <td colspan="7" class="text-center">Belum ada data anggota.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require 'layout/footer.php'; ?>
