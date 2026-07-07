<?php
require_once __DIR__ . '/../config/koneksi.php';

// ambil next id_angsuran
$carikode = mysqli_query($koneksi, "SELECT MAX(id_angsuran) FROM angsuran") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
$hasilkode = ($datakode && $datakode[0] !== null) ? ((int)$datakode[0] + 1) : 1;

// ambil daftar peminjaman untuk dipilih
$opsipeminjaman = mysqli_query(
    $koneksi,
    "SELECT id_peminjaman FROM peminjaman ORDER BY id_peminjaman DESC"
) or die(mysqli_error($koneksi));

if (isset($_POST['simpan'])) {
    $id_angsuran    = (int)$_POST['id_angsuran'];
    $id_peminjaman  = (int)$_POST['id_peminjaman'];
    $tgl_bayar      = $_POST['tgl_bayar'];
    $jlh_bayar      = (int)$_POST['jlh_bayar'];
    $sisa_pinjaman  = (int)$_POST['sisa_pinjaman'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO angsuran (id_angsuran, id_peminjaman, tgl_bayar, jlh_bayar, sisa_pinjaman)
         VALUES ('$id_angsuran', '$id_peminjaman', '$tgl_bayar', '$jlh_bayar', '$sisa_pinjaman')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=angsuran">';
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
                <h1 class="m-0 text-dark">Tambah Angsuran</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-secondary float-right" href="index.php?page=angsuran">Kembali</a>
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
                        <label for="id_angsuran">ID Angsuran</label>
                        <input type="text" name="id_angsuran" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="id_peminjaman">ID Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman" class="form-control" required>
                            <?php while ($p = mysqli_fetch_array($opsipeminjaman)) { ?>
                                <option value="<?= $p['id_peminjaman']; ?>"><?= $p['id_peminjaman']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jlh_bayar">Jumlah Bayar</label>
                        <input type="number" name="jlh_bayar" id="jlh_bayar" class="form-control" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="sisa_pinjaman">Sisa Pinjaman</label>
                        <input type="number" name="sisa_pinjaman" id="sisa_pinjaman" class="form-control" min="0" required>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan" value="1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

