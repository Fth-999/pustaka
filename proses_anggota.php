<?php
require 'koneksi.php';

// ================= BLOK 1: SIMPAN DATA BARU =================
if (isset($_POST['submit'])) {
    $nim   = trim($_POST['nim']);
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');

    // Email / no HP kosong disimpan sebagai NULL
    $email = $email === '' ? null : $email;
    $no_hp = $no_hp === '' ? null : $no_hp;

    // Cek duplikat NIM
    $cek = $koneksi->prepare("SELECT id_anggota FROM anggota WHERE nim = ?");
    $cek->bind_param("s", $nim);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        $nim_aman = htmlspecialchars($nim);
        redirect('form_anggota.php', 'warning',
            "NIM <b>$nim_aman</b> sudah terdaftar. Gunakan NIM lain.");
    }

    // Simpan dengan prepared statement
    $stmt = $koneksi->prepare(
        "INSERT INTO anggota (nim, nama, email, no_hp) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $nim, $nama, $email, $no_hp);

    if ($stmt->execute()) {
        redirect('anggota.php', 'success', 'Data anggota berhasil disimpan.');
    } else {
        redirect('form_anggota.php', 'danger', 'Gagal menyimpan data.');
    }
}

// ================= BLOK 2: UBAH DATA =================
if (isset($_POST['update'])) {
    $id_anggota = (int) $_POST['id_anggota'];
    $nim        = trim($_POST['nim']);
    $nama       = trim($_POST['nama']);
    $email      = trim($_POST['email'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    $email = $email === '' ? null : $email;
    $no_hp = $no_hp === '' ? null : $no_hp;

    // Cek duplikat NIM, kecualikan data milik anggota itu sendiri
    $sql = "SELECT id_anggota FROM anggota WHERE nim = ? AND id_anggota != ?";
    $cek = $koneksi->prepare($sql);
    $cek->bind_param("si", $nim, $id_anggota);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        $nim_aman = htmlspecialchars($nim);
        redirect("edit_anggota.php?id=$id_anggota", 'warning',
            "NIM <b>$nim_aman</b> sudah dipakai anggota lain. Gunakan NIM lain.");
    }

    $stmt = $koneksi->prepare(
        "UPDATE anggota SET nim = ?, nama = ?, email = ?, no_hp = ?
         WHERE id_anggota = ?"
    );
    $stmt->bind_param("ssssi", $nim, $nama, $email, $no_hp, $id_anggota);

    if ($stmt->execute()) {
        redirect('anggota.php', 'success', 'Data anggota berhasil diubah.');
    } else {
        redirect("edit_anggota.php?id=$id_anggota", 'danger', 'Gagal mengubah data.');
    }
}

// Jika file ini dibuka langsung tanpa mengirim form
header('Location: anggota.php');
exit;
