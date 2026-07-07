<?php
  require_once("config/koneksi.php");
?>

<?php
$kd = isset($_GET['kd']) ? $_GET['kd'] : '';

if($kd === ''){
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=guru'>";
    exit;
}

$kdEsc = mysqli_real_escape_string($koneksi, $kd);

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM guru WHERE kd_guru='$kdEsc'"
);

if($hapus){
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=guru'>";
    exit;
}

echo "<meta http-equiv='refresh' content='0;url=index.php?page=guru'>";
exit;

