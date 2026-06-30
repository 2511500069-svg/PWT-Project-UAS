<?php
require_once __DIR__ . '/../config/koneksi.php';

$carikode = mysqli_query($koneksi, "SELECT MAX(id_petugas) FROM petugas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
$hasilkode = ($datakode && $datakode[0] !== null) ? ((int)$datakode[0] + 1) : 1;

if (isset($_POST['simpan'])) {
    $id_petugas = (int)$_POST['id_petugas'];
    $nama       = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $no_hp      = $_POST['no_hp'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO petugas (id_petugas, nama, jabatan, no_hp) VALUES ('$id_petugas', '$nama', '$jabatan', '$no_hp')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=petugas">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal Disimpan</h4>
        </div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Petugas</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-secondary float-right" href="index.php?page=petugas">Kembali</a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="id_petugas">ID Petugas</label>
                        <input type="text" name="id_petugas" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" required>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

