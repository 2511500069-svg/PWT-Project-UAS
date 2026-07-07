<?php
  require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'] ?? '';

$edit = mysqli_fetch_array(
    mysqli_query(
        $koneksi,
        "SELECT * FROM guru WHERE kd_guru='$kd'"
    )
);

if(isset($_POST['ubah'])){
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query(
        $koneksi,
        "UPDATE guru SET
            nm_guru='$nm_guru',
            jenkel='$jenkel',
            pend_terakhir='$pend_terakhir',
            hp='$hp',
            alamat='$alamat'
         WHERE kd_guru='$kd_guru'"
    );

    if($update){
        echo '<div class="alert alert-info">Berhasil Disimpan</div>';
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
                        <input type="text" name="kd_guru" value="<?= $edit['kd_guru'] ?? '' ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nm_guru">Nama Guru</label>
                        <input type="text" name="nm_guru" value="<?= $edit['nm_guru'] ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <input type="text" name="jenkel" value="<?= $edit['jenkel'] ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                        <input type="text" name="pend_terakhir" value="<?= $edit['pend_terakhir'] ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="hp">No Hp</label>
                        <input type="text" name="hp" value="<?= $edit['hp'] ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" value="<?= $edit['alamat'] ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="ubah" value="Simpan">
                        <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

