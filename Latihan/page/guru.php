<?php
  require_once("config/koneksi.php");
?>

<?php
// Tambahkan debug singkat agar bisa terlihat jika halaman terpanggil
// (hapus jika sudah berfungsi)
// echo '<div style="padding:10px;background:#fee">page=guru loaded</div>';

if(isset($_GET['action']) && $_GET['action'] === 'hapus'){
    $kd = $_GET['kd'] ?? '';
    if($kd !== ''){
        $kdEsc = mysqli_real_escape_string($koneksi, $kd);
        mysqli_query($koneksi, "DELETE FROM guru WHERE kd_guru='$kdEsc'");
    }
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=guru">';
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm">Tambah Guru</a>

<table class="table table-striped">
<thead>
<tr>
<th>NO</th>
<th>Kode Guru</th>
<th>Nama Guru</th>
<th>Jenis Kelamin</th>
<th>Pendidikan Terakhir</th>
<th>No HP</th>
<th>Aksi</th>
</tr>
</thead>

<?php
$no = 0;
$query = mysqli_query($koneksi, "SELECT * FROM guru");
while($result = mysqli_fetch_array($query)){
    $no++;
?>
<tbody>
<tr>
<td><?= $no; ?></td>
<td><?= $result['kd_guru']; ?></td>
<td><?= $result['nm_guru']; ?></td>
<td><?= $result['jenkel']; ?></td>
<td><?= $result['pend_terakhir']; ?></td>
<td><?= $result['hp']; ?></td>
<td>
    <a href="index.php?page=edit_guru&kd=<?= $result['kd_guru']; ?>" class="badge badge-warning">Edit</a>
    <a href="index.php?page=hapus_guru&action=hapus&kd=<?= $result['kd_guru']; ?>" class="badge badge-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>
</tr>
</tbody>
<?php } ?>
</table>


</div>
</div>
</div>
</div>

