<?php
require 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare("DELETE FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    redirect('buku.php', 'success', 'Data buku berhasil dihapus.');
} else {
    redirect('buku.php', 'danger', 'Data buku tidak ditemukan atau gagal dihapus.');
}
