<?php
  require_once("config/koneksi.php");
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $kd = $_GET['kd'] ?? '';
        if($kd === ''){
            echo "<meta http-equiv='refresh' content='0;url=index.php?page=siswa'>";
            exit;
        }
        $kdEsc = mysqli_real_escape_string($koneksi, $kd);
        $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE id_kelas = '$kdEsc'");
        if ($query){
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content=1;url=index.php?page=siswa">';
        }
    }
}
?>
<div class="content">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm">
            Tambah Siswa </a>
            <table class="table table-striped">
<thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>No Hp</th>
                        <th>Kd Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM siswa");
                while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>
                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['NIS']; ?></td>
                        <td><?= $result['nm_siswa']; ?></td>
                        <td><?= $result['jenkel']; ?></td>
                        <td><?= $result['hp']; ?></td>
<td><?= $result['id_kelas']; ?></td>
                        <td>
                            <a href="index.php?page=siswa&action=hapus&kd=<?= $result['id_kelas']; ?>" onclick="return confirm('Yakin hapus?')" title="">
                                <span class="badge badge-danger">Hapus</span>
                            </a>
                            <a href="index.php?page=edit_siswa&kd=<?= $result['id_kelas']; ?>" title="">
                                <span class="badge badge-warning">Edit</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</div>