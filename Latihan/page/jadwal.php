<?php
require_once("config/koneksi.php");

// Cari tabel jadwal yang tersedia
$tableCandidates = [
    'jadwal_kelas' => ['id_jadwal','hari','jam','mapel','kd_guru','id_kelas'],
    'tabel_kelas'  => ['id_jadwal','hari','jam','mapel','kd_guru','id_kelas'],
];

$activeTable = null;
foreach (array_keys($tableCandidates) as $table) {
    $check = mysqli_query($koneksi, "SHOW TABLES LIKE '$table'");
    if ($check && mysqli_num_rows($check) > 0) {
        $activeTable = $table;
        break;
    }
}

if (!$activeTable) {
    echo '<div class="alert alert-danger">Data jadwal tidak ditemukan. Pastikan tabel "jadwal_kelas" atau "tabel_kelas" ada di database.</div>';
    exit;
}

// Ambil data (pakai SELECT hari, jam, mapel tapi tetap aman untuk tabel lain)
$query = mysqli_query($koneksi, "SELECT hari, jam, mapel FROM $activeTable");
if (!$query) {
    echo '<div class="alert alert-danger">Query jadwal gagal: ' . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8') . '</div>';
    exit;
}

$map = []; // [hari][jam] => mapel
$hariList = [];
$jamList = [];

while ($row = mysqli_fetch_assoc($query)) {
    $hari  = trim((string)($row['hari'] ?? ''));
    $jam   = trim((string)($row['jam'] ?? ''));
    $mapel = trim((string)($row['mapel'] ?? ''));

    if ($hari === '' || $jam === '') continue;

    if (!in_array($hari, $hariList, true)) $hariList[] = $hari;
    if (!in_array($jam, $jamList, true)) $jamList[] = $jam;

    $map[$hari][$jam] = $mapel;
}

// Urutkan hari (kalau cocok dengan pola)
$urutanHari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
$hariListSorted = $hariList;
usort($hariListSorted, function($a, $b) use ($urutanHari) {
    $ia = array_search($a, $urutanHari, true);
    $ib = array_search($b, $urutanHari, true);
    $ia = ($ia === false) ? PHP_INT_MAX : $ia;
    $ib = ($ib === false) ? PHP_INT_MAX : $ib;
    return $ia <=> $ib;
});

// Urutkan jam (ambil angka bila memungkinkan)
$jamListSorted = $jamList;
usort($jamListSorted, function($a, $b) {
    $na = preg_match('/^(?:Jam\s*)?(\d+(?:\.\d+)?)$/i', $a, $m1) ? (float)$m1[1] : null;
    $nb = preg_match('/^(?:Jam\s*)?(\d+(?:\.\d+)?)$/i', $b, $m2) ? (float)$m2[1] : null;
    if ($na !== null && $nb !== null) return $na <=> $nb;
    return strcmp($a, $b);
});
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Jadwal (Hari x Jam)</h5>

                <?php if (empty($hariListSorted) || empty($jamListSorted)) { ?>
                    <div class="alert alert-info">
                        Belum ada data jadwal (tabel sumber: <b><?= htmlspecialchars($activeTable, ENT_QUOTES, 'UTF-8') ?></b>).
                    </div>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th style="min-width: 120px;">Hari</th>
                                    <?php foreach ($jamListSorted as $jam) { ?>
                                        <th><?= htmlspecialchars($jam, ENT_QUOTES, 'UTF-8'); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hariListSorted as $hari) { ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($hari, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                        <?php foreach ($jamListSorted as $jam) { ?>
                                            <td>
                                                <?php
                                                    $val = $map[$hari][$jam] ?? '';
                                                    echo $val !== '' ? htmlspecialchars($val, ENT_QUOTES, 'UTF-8') : '-';
                                                ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>

                <button class="btn btn-light" onclick="window.print()">Cetak Jadwal</button>
            </div>
        </div>
    </div>
</div>

