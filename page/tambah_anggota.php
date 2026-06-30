<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Anggota</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../config/koneksi.php';


// Ambil next id_anggota
$carikode = mysqli_query($koneksi, "SELECT MAX(id_anggota) FROM anggota") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode && $datakode[0] !== null) {
    $hasilkode = (int)$datakode[0] + 1;
} else {
    $hasilkode = 1;
}

// pastikan session ada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_anggota = $_POST['id_anggota'];
    $nama       = $_POST['nama'];
    $nik        = $_POST['nik'];
    $alamat     = $_POST['alamat'];
    $no_hp      = $_POST['no_hp'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO anggota (id_anggota, nama, nik, alamat, no_hp) VALUES ('$id_anggota', '$nama', '$nik', '$alamat', '$no_hp')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=anggota">';
    } else {
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
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
                            <input type="text" name="id_anggota" value="<?= $hasilkode; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="No HP" class="form-control">
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

