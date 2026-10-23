<?php
require 'koneksi.php';

// Fungsi bantu upload sampul.
// Mengembalikan nama file, atau null jika tidak ada file yang diupload.
function upload_sampul($file)
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    // Tambahkan waktu di depan nama file agar tidak bentrok
    $nama_file = time() . '_' . basename($file['name']);
    move_uploaded_file($file['tmp_name'], 'sampul/' . $nama_file);
    return $nama_file;
}

// ================= BLOK 1: SIMPAN DATA BARU =================
if (isset($_POST['submit'])) {
    $kode_buku    = trim($_POST['kode_buku']);
    $judul        = trim($_POST['judul']);
    $pengarang    = trim($_POST['pengarang']);
    $penerbit     = trim($_POST['penerbit']);
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok         = (int) $_POST['stok'];

    // a. Cek duplikat kode buku
    $cek = $koneksi->prepare("SELECT id_buku FROM buku WHERE kode_buku = ?");
    $cek->bind_param("s", $kode_buku);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        $kode = htmlspecialchars($kode_buku);
        redirect('form.php', 'warning',
            "Kode buku <b>$kode</b> sudah terdaftar. Gunakan kode lain.");
    }

    // b. Upload sampul (jika ada)
    $nama_sampul = upload_sampul($_FILES['sampul']) ?? '';

    // c. Simpan dengan prepared statement
    $sql = "INSERT INTO buku
            (kode_buku, judul, pengarang, penerbit, tahun_terbit, stok, sampul)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssiis", $kode_buku, $judul, $pengarang, $penerbit,
        $tahun_terbit, $stok, $nama_sampul);

    if ($stmt->execute()) {
        redirect('buku.php', 'success', 'Data buku berhasil disimpan.');
    } else {
        redirect('form.php', 'danger', 'Gagal menyimpan data.');
    }
}

// ================= BLOK 2: UBAH DATA =================
if (isset($_POST['update'])) {
    $id_buku      = (int) $_POST['id_buku'];
    $judul        = trim($_POST['judul']);
    $pengarang    = trim($_POST['pengarang']);
    $penerbit     = trim($_POST['penerbit']);
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok         = (int) $_POST['stok'];

    $nama_sampul = upload_sampul($_FILES['sampul']);

    if ($nama_sampul) {
        // Ada sampul baru -> kolom sampul ikut diubah
        $sql = "UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?,
                tahun_terbit = ?, stok = ?, sampul = ?
                WHERE id_buku = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssiisi", $judul, $pengarang, $penerbit,
            $tahun_terbit, $stok, $nama_sampul, $id_buku);
    } else {
        // Tidak ada sampul baru -> kolom sampul tidak diubah
        $sql = "UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?,
                tahun_terbit = ?, stok = ?
                WHERE id_buku = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssiii", $judul, $pengarang, $penerbit,
            $tahun_terbit, $stok, $id_buku);
    }

    if ($stmt->execute()) {
        redirect('buku.php', 'success', 'Data buku berhasil diubah.');
    } else {
        redirect("edit.php?id=$id_buku", 'danger', 'Gagal mengubah data.');
    }
}

// Jika file ini dibuka langsung tanpa mengirim form
header('Location: buku.php');
exit;
