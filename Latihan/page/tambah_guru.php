<?php
  require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
// kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(kd_guru) FROM guru") or die(mysqli_error($koneksi));

$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0]) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "G-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "G-001";
}

if(isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO guru (kd_guru, nm_guru, jenkel, pend_terakhir, hp, alamat)
         VALUES ('$kd_guru', '$nm_guru', '$jenkel', '$pend_terakhir', '$hp', '$alamat')"
    );

    if ($insert) {
        // buat user untuk login
        $username = $kd_guru;
        $password = '1234';
        $role = 'guru';
        mysqli_query(
            $koneksi,
            "INSERT INTO user (username, password, role)
             VALUES ('$username', '$password', '$role')"
        );

        echo '<div class="alert alert-success">Data Berhasil Disimpan</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
        exit;
    } else {
        echo '<div class="alert alert-warning">Gagal Disimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">

                    <div class="form-group">
                        <label for="kd_guru">Kode Guru</label>
                        <input type="text" name="kd_guru" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nm_guru">Nama Guru</label>
                        <input type="text" name="nm_guru" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <input type="text" name="jenkel" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                        <input type="text" name="pend_terakhir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="hp">No Hp</label>
                        <input type="text" name="hp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

