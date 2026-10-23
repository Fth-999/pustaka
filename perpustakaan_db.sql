CREATE DATABASE IF NOT EXISTS perpustakaan_db;
USE perpustakaan_db;

CREATE TABLE buku (
    id_buku INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(20) NOT NULL UNIQUE,
    judul VARCHAR(200) NOT NULL,
    pengarang VARCHAR(100),
    penerbit VARCHAR(100),
    tahun_terbit INT(4),
    stok INT(11) DEFAULT 0,
    sampul VARCHAR(255)
);

CREATE TABLE anggota (
    id_anggota INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NULL,
    no_hp VARCHAR(20) NULL,
    dibuat_pada TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);
