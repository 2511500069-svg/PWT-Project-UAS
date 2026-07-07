<?php
// Import koneksi (menghasilkan variabel $koneksi)
require_once("config/koneksi.php");

// Ambil kode dari URL (sesuai link di halaman daftar)
$kd = isset($_GET['kd']) ? $_GET['kd'] : '';

// Tetap berada di halaman ekstra (tidak 404)
if ($kd === '') {
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=ekstra2511500069'>";
    exit;
}

$kdEsc = mysqli_real_escape_string($koneksi, $kd);

// Hapus data sesuai database: jadwal, tabel: ekstra_2511500069
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM ekstra_2511500069 WHERE id_ekstra069='$kdEsc'"
);

// Redirect balik ke halaman daftar ekstra agar tetap berada di bagian Extra
if ($hapus) {
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=ekstra2511500069'>";
    exit;
}

echo "<meta http-equiv='refresh' content='0;url=index.php?page=ekstra2511500069'>";
exit;

