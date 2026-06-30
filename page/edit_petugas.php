<?php
require_once __DIR__ . '/../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$edit = mysqli_fetch_array(
    mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$id'")
);

if (!$edit) {
    echo "Data tidak ditemukan";
    exit;
}

if (isset($_POST['simpan'])) {
    $id_petugas = (int)$_POST['id_petugas'];
    $nama       = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $no_hp      = $_POST['no_hp'];

    $update = mysqli_query(
        $koneksi,
        "UPDATE petugas SET nama='$nama', jabatan='$jabatan', no_hp='$no_hp' WHERE id_petugas='$id_petugas'"
    ) or die(mysqli_error($koneksi));

    if ($update) {
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
                <h1 class="m-0 text-dark">Edit Petugas</h1>
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
                        <input type="text" name="id_petugas" value="<?= $edit['id_petugas']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" value="<?= $edit['nama']; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" value="<?= $edit['jabatan']; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" value="<?= $edit['no_hp']; ?>" class="form-control" required>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

