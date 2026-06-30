<?php
require_once __DIR__ . '/../config/koneksi.php';

// next id_peminjaman
$carikode = mysqli_query($koneksi, "SELECT MAX(id_peminjaman) FROM peminjaman") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
$hasilkode = ($datakode && $datakode[0] !== null) ? ((int)$datakode[0] + 1) : 1;

$opsiAnggota = mysqli_query($koneksi, "SELECT id_anggota, nama FROM anggota ORDER BY id_anggota DESC") or die(mysqli_error($koneksi));
$opsiPetugas = mysqli_query($koneksi, "SELECT id_petugas, nama, jabatan, no_hp FROM petugas ORDER BY id_petugas DESC") or die(mysqli_error($koneksi));

if (isset($_POST['simpan'])) {
    $id_peminjaman  = (int)$_POST['id_peminjaman'];
    $id_anggota    = (int)$_POST['id_anggota'];
    $id_petugas    = (int)$_POST['id_petugas'];
    $tgl_pinjaman  = $_POST['tgl_pinjaman'];
    $jlh_pinjaman  = (int)$_POST['jlh_pinjaman'];
    $lama_angsuran = (int)$_POST['lama_angsuran'];
    $status        = $_POST['status'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO peminjaman (id_peminjaman, id_anggota, id_petugas, tgl_pinjaman, jlh_pinjaman, lama_angsuran, status)
         VALUES ('$id_peminjaman', '$id_anggota', '$id_petugas', '$tgl_pinjaman', '$jlh_pinjaman', '$lama_angsuran', '$status')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=peminjaman">';
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
                <h1 class="m-0 text-dark">Tambah Peminjaman</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-secondary float-right" href="index.php?page=peminjaman">Kembali</a>
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
                        <label for="id_peminjaman">ID Peminjaman</label>
                        <input type="text" name="id_peminjaman" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="id_anggota">ID Anggota</label>
                        <select name="id_anggota" id="id_anggota" class="form-control" required>
                            <?php while ($a = mysqli_fetch_array($opsiAnggota)) { ?>
                                <option value="<?= $a['id_anggota']; ?>"><?= $a['nama']; ?> (<?= $a['id_anggota']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_petugas">ID Petugas</label>
                        <select name="id_petugas" id="id_petugas" class="form-control" required>
                            <?php while ($p = mysqli_fetch_array($opsiPetugas)) { ?>
                                <option value="<?= $p['id_petugas']; ?>">
                                    <?= $p['nama']; ?> (<?= $p['jabatan']; ?>, <?= $p['id_petugas']; ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_pinjaman">Tanggal Pinjaman</label>
                        <input type="date" name="tgl_pinjaman" id="tgl_pinjaman" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jlh_pinjaman">Jumlah Pinjaman</label>
                        <input type="number" name="jlh_pinjaman" id="jlh_pinjaman" class="form-control" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="lama_angsuran">Lama Angsuran</label>
                        <input type="number" name="lama_angsuran" id="lama_angsuran" class="form-control" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif">aktif</option>
                            <option value="lunas">lunas</option>
                        </select>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

