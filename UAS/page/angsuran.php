<?php
require_once __DIR__ . '/../config/koneksi.php';

// Data angsuran
$data = mysqli_query(
    $koneksi,
    "SELECT a.*, p.id_peminjaman, p.id_anggota, a.id_angsuran
     FROM angsuran a
     LEFT JOIN peminjaman p ON p.id_peminjaman = a.id_peminjaman
     ORDER BY a.id_angsuran DESC"
) or die(mysqli_error($koneksi));
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Angsuran</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="index.php?page=tambah_angsuran">+ Tambah Angsuran</a>
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
                            <th>ID Peminjaman</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Bayar</th>
                            <th>Sisa Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $row['id_angsuran']; ?></td>
                                <td><?= $row['id_peminjaman']; ?></td>
                                <td><?= $row['tgl_bayar']; ?></td>
                                <td><?= $row['jlh_bayar']; ?></td>
                                <td><?= $row['sisa_pinjaman']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

