<?php
require_once __DIR__ . '/../config/koneksi.php';

// Tampilkan data peminjaman
$data = mysqli_query(
    $koneksi,
    "SELECT p.*, a.nama AS nama_anggota
     FROM peminjaman p
     LEFT JOIN anggota a ON a.id_anggota = p.id_anggota
     ORDER BY p.id_peminjaman DESC"
) or die(mysqli_error($koneksi));
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Peminjaman</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="index.php?page=tambah_peminjaman">+ Tambah Peminjaman</a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Anggota</th>
                            <th>Petugas (id)</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Lama Angsuran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $row['id_peminjaman']; ?></td>
                                <td><?= $row['nama_anggota'] ?? '-'; ?></td>
                                <td><?= $row['id_petugas']; ?></td>
                                <td><?= $row['tgl_pinjaman']; ?></td>
                                <td><?= $row['jlh_pinjaman']; ?></td>
                                <td><?= $row['lama_angsuran']; ?></td>
                                <td><?= $row['status']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

