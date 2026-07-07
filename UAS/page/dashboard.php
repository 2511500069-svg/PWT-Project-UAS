<?php
require_once __DIR__ . '/../config/koneksi.php';


// Dashboard sederhana (sesuaikan nanti kalau ada tabel lain)
// Pastikan tampil jika user sudah login.
if (!isset($_SESSION['username'])) {
    echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Selamat datang</h5>
                <p class="card-text">Modul koperasi desa yang tersedia saat ini: <b>Anggota</b>.</p>
            </div>
        </div>
    </div>
</section>

