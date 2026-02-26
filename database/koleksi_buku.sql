use koleksi_buku;

CREATE TABLE kategori (
    idkategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE buku (
    idbuku INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(20),
    judul VARCHAR(500),
    pengarang VARCHAR(200),
    idkategori INT,
    FOREIGN KEY (idkategori) REFERENCES kategori(idkategori)
);
