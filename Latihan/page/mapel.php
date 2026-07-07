<?php
// Halaman: Data Mapel
require_once "config/koneksi.php";

// Hapus mapel
if (isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $kd = $_GET['kd'] ?? '';
    if ($kd !== '') {
        mysqli_query($koneksi, "DELETE FROM mapel WHERE kd_mapel = '$kd'");
    }
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=mapel">';
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Mapel</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm">
                    Tambah Mapel
                </a>

                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kd Mapel</th>
                            <th>Nama Mapel</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM mapel");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['kd_mapel']; ?></td>
                                <td><?= $result['nm_mapel']; ?></td>
                                <td><?= $result['kkm']; ?></td>
                                <td>
                                    <a href="index.php?page=mapel&action=hapus&kd=<?= $result['kd_mapel']; ?>"
                                       class="badge badge-danger"
                                       onclick="return confirm('Yakin hapus?')">Hapus</a>
                                    <a href="index.php?page=edit_mapel&kd=<?= $result['kd_mapel']; ?>"
                                       class="badge badge-warning">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

