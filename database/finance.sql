CREATE DATABASE finance_app;

USE finance_app;

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE,
    keterangan VARCHAR(255),
    kategori VARCHAR(100),
    jenis VARCHAR(50),
    jumlah INT
);