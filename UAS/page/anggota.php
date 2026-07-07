<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Anggota</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../config/koneksi.php';

// Ambil data anggota (tabel saja)
$data = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id_anggota DESC") or die(mysqli_error($koneksi));
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <a class="btn btn-primary" href="index.php?page=tambah_anggota">+ Tambah Anggota</a>
                </div>
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $row['id_anggota']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['nik']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['no_hp']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="index.php?page=edit_anggota&kd=<?= $row['id_anggota']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


