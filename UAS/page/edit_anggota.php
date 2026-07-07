<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Anggota</h1>
            </div>
        </div>
    </div>
</div> 

<?php
require_once __DIR__ . '/../config/koneksi.php';

$kd = isset($_GET['kd']) ? (int)$_GET['kd'] : 0;
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$kd'"));

if (!$edit) {
    echo "Data tidak ditemukan";
    exit;
}

if (isset($_POST['tambah'])) {
    $id_anggota = (int)$_POST['id_anggota'];
    $nama       = $_POST['nama'];
    $nik        = $_POST['nik'];
    $alamat     = $_POST['alamat'];
    $no_hp      = $_POST['no_hp'];

    $insert = mysqli_query(
        $koneksi,
        "UPDATE anggota SET nama='$nama', nik='$nik', alamat='$alamat', no_hp='$no_hp' WHERE id_anggota='$id_anggota'"
    );

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=anggota">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal Disimpan</h4>
        </div>';
    }
}
?>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="id_anggota">ID Anggota</label>
                                <input type="text" name="id_anggota" value="<?= $edit['id_anggota']; ?>" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" value="<?= $edit['nama']; ?>" placeholder="Nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" value="<?= $edit['nik']; ?>" placeholder="NIK" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" value="<?= $edit['alamat']; ?>" placeholder="Alamat" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" name="no_hp" id="no_hp" value="<?= $edit['no_hp']; ?>" placeholder="No HP" class="form-control" required>
                            </div>

                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

