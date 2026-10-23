<?php
// Variabel ini diisi oleh halaman yang memanggil header.php
$judul_halaman = $judul_halaman ?? 'Perpustakaan';
$menu_aktif    = $menu_aktif ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul_halaman ?> | Perpustakaan</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand" href="buku.php">Perpustakaan</a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $menu_aktif == 'buku' ? 'active' : '' ?>"
                       href="buku.php">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $menu_aktif == 'anggota' ? 'active' : '' ?>"
                       href="anggota.php">Anggota</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
<?php if (isset($_SESSION['pesan'])) : ?>
    <div class="alert alert-<?= $_SESSION['pesan']['tipe'] ?> alert-dismissible">
        <?= $_SESSION['pesan']['teks'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['pesan']); ?>
<?php endif; ?>
