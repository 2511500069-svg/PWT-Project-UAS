<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!--  Judul diubah -->
        <h1 class="m-0 text-dark">Edit Data Ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
//  Ambil kode dari URL (sesuai kolom utama)
$kd = $_GET['kd'];
// Ubah nama tabel & kolom sesuai database kamu: ekstra_nimanda & id_ekstra033
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ekstra_2511500069 WHERE id_ekstra069='$kd' "));

if(isset($_POST['ubah'])){ //  Nama tombol diubah jadi 'ubah' biar jelas
  //  Ambil semua data sesuai kolom yang ada
  $id_ekstra069   = $_POST['id_ekstra069'];
  $nama_ekstra069 = $_POST['nama_ekstra069'];
  $ket069         = $_POST['ket069'];
  $semester069    = $_POST['semester069'];
  $thn_ajaran069  = $_POST['thn_ajaran069'];

  //  Query UPDATE diubah sesuai nama tabel & kolom lengkap
$update = mysqli_query($koneksi,"UPDATE ekstra_2511500069 SET 
            nama_ekstra069  = '$nama_ekstra069',
            ket069          = '$ket069',
            semester069     = '$semester069',
            thn_ajaran069   = '$thn_ajaran069'
            WHERE id_ekstra069 = '$id_ekstra069' ");

  if ($update) {
    echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Berhasil </h5>
      Data Berhasil Diubah
    </div>';
    //  Redirect ke halaman daftar ekstra
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500069">';
  }else{
    echo '<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-times"></i> Gagal </h5>
      Data Gagal Diubah : '.mysqli_error($koneksi).'
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

            <!--  Semua kolom disesuaikan dengan database -->
            <div class="form-group">
              <label for="id_ekstra069">Kode Ekstra</label>
              <input type="text" name="id_ekstra069" value="<?=$edit['id_ekstra069']; ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label for="nama_ekstra069">Nama Ekstrakurikuler</label>
              <input type="text" name="nama_ekstra069" value="<?=$edit['nama_ekstra069']; ?>" id="nama_ekstra069" placeholder="Contoh: Pramuka / Paskibra" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="ket069">Keterangan</label>
              <input type="text" name="ket069" value="<?=$edit['ket069']; ?>" id="ket069" placeholder="Keterangan Tambahan" class="form-control">
            </div>

            <div class="form-group">
              <label for="semester069">Semester</label>
              <input type="text" name="semester069" value="<?=$edit['semester069']; ?>" id="semester069" placeholder="Contoh: Ganjil / Genap" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="thn_ajaran069">Tahun Ajaran</label>
              <input type="text" name="thn_ajaran069" value="<?=$edit['thn_ajaran069']; ?>" id="thn_ajaran069" placeholder="Contoh: 2025/2026" class="form-control" required>
            </div>

            <div class="card-footer">
              <!--  Nama tombol diubah & tambah ikon -->
              <input type="submit" class="btn btn-primary" name="ubah" value="Simpan Perubahan">
<a href="index.php?page=ekstra2511500069" class="btn btn-secondary">Kembali</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>