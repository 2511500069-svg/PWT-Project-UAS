<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php?page=tambah_ekstra2511500069" class="btn btn-primary">Tambah</a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Ekstra</th>
                                <th>Nama Ekstrakurikuler</th>
                                <th>Keterangan</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500069 ORDER BY id_ekstra069 DESC");
                            if($result && mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $kd = $row['id_ekstra069'];
                                    echo '<tr>';
                                    echo '<td>'.htmlspecialchars($row['id_ekstra069']).'</td>';
                                    echo '<td>'.htmlspecialchars($row['nama_ekstra069']).'</td>';
                                    echo '<td>'.htmlspecialchars($row['ket069']).'</td>';
                                    echo '<td>'.htmlspecialchars($row['semester069']).'</td>';
                                    echo '<td>'.htmlspecialchars($row['thn_ajaran069']).'</td>';
                                    echo '<td>';
                                    echo '<a class="btn btn-info btn-sm" href="index.php?page=edit_ekstra2511500069&kd='.urlencode($kd).'">Edit</a> '; 
                                    echo '<a class="btn btn-danger btn-sm" href="index.php?page=hapus_ekstra2511500069&kd='.urlencode($kd).'" onclick="return confirm(\"Yakin hapus?\")">Hapus</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Data kosong</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

