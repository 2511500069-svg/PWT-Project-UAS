<?php
require_once("config/koneksi.php");

// Ambil data untuk dropdown
$kelas = mysqli_query($koneksi, "SELECT Id_kelas, Nm_kelas FROM kelas ORDER BY Nm_kelas");
$guru  = mysqli_query($koneksi, "SELECT kd_guru, Nm_guru FROM guru ORDER BY Nm_guru");
$mapel = mysqli_query($koneksi, "SELECT id_mapel, Nm_mapel FROM mapel ORDER BY Nm_mapel");

if (isset($_POST['simpan'])) {
    $hari    = $_POST['hari'] ?? '';
    $jam     = $_POST['jam'] ?? '';
    $mapelId = $_POST['mapel'] ?? '';
    $kdGuru  = $_POST['kd_guru'] ?? '';
    $idKelas = $_POST['id_kelas'] ?? '';

    // Validasi minimal
    if ($hari === '' || $jam === '' || $mapelId === '' || $kdGuru === '' || $idKelas === '') {
        echo '<div class="alert alert-danger">Data belum lengkap.</div>';
    } else {
        $sql = "INSERT INTO jadwal_kelas (hari, jam, mapel, kd_guru, id_kelas) VALUES ('$hari', '$jam', '$mapelId', '$kdGuru', '$idKelas')";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            echo '<div class="alert alert-success">Jadwal Berhasil Disimpan</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
        } else {
            echo '<div class="alert alert-danger">Gagal menyimpan jadwal: ' . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8') . '</div>';
        }
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jadwal</h1>
</div>
</div>
</div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST">
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                            <option value="">-- pilih hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jam</label>
                        <input type="text" name="jam" class="form-control" placeholder="contoh: 1 / Jam 1 / 07:00" required>
                    </div>

                    <div class="form-group">
                        <label>Mapel</label>
                        <select name="mapel" class="form-control" required>
                            <option value="">-- pilih mapel --</option>
                            <?php while($m = mysqli_fetch_array($mapel)) { ?>
                                <option value="<?= $m['id_mapel']; ?>"><?= htmlspecialchars($m['Nm_mapel'] ?? ($m['nama_mapel'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kd Guru</label>
                        <select name="kd_guru" class="form-control" required>
                            <option value="">-- pilih guru --</option>
                            <?php while($g = mysqli_fetch_array($guru)) { ?>
                                <option value="<?= $g['kd_guru']; ?>"><?= htmlspecialchars($g['Nm_guru'] ?? ($g['nama_guru'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control" required>
                            <option value="">-- pilih kelas --</option>
                            <?php while($k = mysqli_fetch_array($kelas)) { ?>
                                <option value="<?= $k['Id_kelas']; ?>"><?= htmlspecialchars($k['Nm_kelas'] ?? '', ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=jadwal" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>

