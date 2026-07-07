

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once "config/koneksi.php";

if(isset($_POST['simpan'])) {
    $id_ekstra069 = $_POST['id_ekstra069'];
    $nama_ekstra069 = $_POST['nama_ekstra069'];
    $ket069 = $_POST['ket069'] ?? '';
    $semester069 = $_POST['semester069'];
    $thn_ajaran069 = $_POST['thn_ajaran069'];

    $query = mysqli_query($koneksi, "INSERT INTO ekstra_2511500069
        (id_ekstra069, nama_ekstra069, ket069, semester069, thn_ajaran069)
        VALUES
        ('$id_ekstra069','$nama_ekstra069','$ket069','$semester069','$thn_ajaran069')");

    if ($query) {
        echo '<div class="alert alert-success">Data Berhasil Disimpan</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500069">';
    } else {
        echo "<div class=\"alert alert-danger\">".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Id Ekstra</label>
                        <input type="text" name="id_ekstra069" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text" name="nama_ekstra069" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="ket069" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" name="semester069" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="thn_ajaran069" class="form-control" required>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                    <a href="index.php?page=ekstra2511500069" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
