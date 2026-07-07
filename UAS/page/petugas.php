<?php
require_once __DIR__ . '/../config/koneksi.php';

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM petugas ORDER BY id_petugas DESC"
) or die(mysqli_error($koneksi));
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Petugas</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="index.php?page=tambah_petugas">+ Tambah Petugas</a>
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
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $row['id_petugas']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jabatan']; ?></td>
                                <td><?= $row['no_hp']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="index.php?page=edit_petugas&id=<?= $row['id_petugas']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

