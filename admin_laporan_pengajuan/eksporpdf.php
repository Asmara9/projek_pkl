<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../database/config.php';

    function tanggal_indonesia($tanggal)
    {
        $bulan_indonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Memecah tanggal input menjadi bagian-bagian
        $tanggal_pisah = explode('-', $tanggal);
        $tahun = $tanggal_pisah[0];
        $bulan = (int)$tanggal_pisah[1]; // Mengubah ke integer agar bisa digunakan di array bulan
        $hari = (int)$tanggal_pisah[2];

        // Menggabungkan hasil
        return $hari . ' ' . $bulan_indonesia[$bulan] . ' ' . $tahun;
    }

    $hari_ini = date('Y-m-d'); // Mendapatkan tanggal saat ini
    $tanggal_indonesia = tanggal_indonesia($hari_ini); // Mengubah format ke Bahasa Indonesia
    $nik = @$_GET['nik'];
    $kodeDecript = decriptData($nik);
    $querypenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_penduduk WHERE nik='$kodeDecript'") or die(mysqli_error($koneksi));

    $kategori = @$_GET['kategori']; // Perbaikan penulisan GET
    $kode_decript_kategori = decriptData($kategori);
    $querykategori = mysqli_query($koneksi, "SELECT id_kategori_pengantar, keterangan FROM tbl_permohonan_surat WHERE id_kategori_pengantar='$kode_decript_kategori'") or die(mysqli_error($koneksi));

    if (mysqli_num_rows($querykategori) > 0) {
        $arr_kategori = mysqli_fetch_assoc($querykategori);
        $Kategori_surat = $arr_kategori['id_kategori_pengantar'];
        $keterangan_lain = $arr_kategori['keterangan'];
    } else {
        $Kategori_surat = 'Tidak diketahui'; // Jika tidak ditemukan
    }

    // Jika tabel ada isinya maka ditampilkan datanya
    if (mysqli_num_rows($querypenduduk) > 0) {
        while ($dt_penduduk = mysqli_fetch_array($querypenduduk)) {

            // Query untuk mendapatkan ketua RT sesuai RT dan RW penduduk
            $queryRT = mysqli_query($koneksi, "SELECT ketua FROM tbl_rt WHERE rt='{$dt_penduduk['rt']}' AND rw='{$dt_penduduk['rw']}'") or die(mysqli_error($koneksi));
            $ketuaRT = "Tidak diketahui"; // Default jika tidak ada ketua RT

            if (mysqli_num_rows($queryRT) > 0) {
                $arr_RT = mysqli_fetch_assoc($queryRT);
                $ketuaRT = $arr_RT['ketua']; // Dapatkan ketua RT dari query
            }

            // Query untuk mendapatkan ketua RW sesuai RW penduduk
            $queryRW = mysqli_query($koneksi, "SELECT ketua FROM tbl_rw WHERE rw='{$dt_penduduk['rw']}'") or die(mysqli_error($koneksi));
            $ketuaRW = "Tidak diketahui"; // Default jika tidak ada ketua RW

            if (mysqli_num_rows($queryRW) > 0) {
                $arr_RW = mysqli_fetch_assoc($queryRW);
                $ketuaRW = $arr_RW['ketua']; // Dapatkan ketua RW dari query
            }

    ?>
            <?php
            // Array untuk konversi bulan ke angka Romawi
            $bulan_romawi = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII'
            ];

            $rt = $dt_penduduk['rt']; // Nomor RT dari penduduk
            $rw = $dt_penduduk['rw']; // Nomor RW dari penduduk
            $nomor_urut = sprintf("%03d", rand(1, 999)); // Nomor urut surat (dapat di-generate atau dari database)
            $bulan = date('n'); // Mendapatkan bulan saat ini (dalam bentuk angka 1-12)
            $tahun = date('Y'); // Tahun saat ini

            // Mengambil angka Romawi dari array berdasarkan bulan saat ini
            $bulan_roman = $bulan_romawi[$bulan];

            // Format nomor surat
            $nomor_surat = "400/$nomor_urut/$rt/$rw/$bulan_roman/$tahun";
            ?>
            <title><?= $dt_penduduk['nama']; ?> <?= $Kategori_surat ?> Nomor: <?= $nomor_surat ?></title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Surat A4</title>
            <style>
                @page {
                    size: A4;
                    margin: 0mm;
                }

                body {
                    font-family: 'Times New Roman', Times, serif;
                    font-size: 12px;
                    margin: 20mm;
                    padding: 0;
                }

                .receipt {
                    padding: 0;
                }

                .center {
                    text-align: center;
                    margin: 0;
                }

                .bold {
                    font-weight: bold;
                }

                .nomor {
                    margin-bottom: 7mm;
                }

                .line {
                    border: 0;
                    border-top: 3px solid black;
                    border-bottom: 1px solid black;
                    padding-top: 2px;
                    margin-top: 5px;
                    margin-bottom: 10px;
                }

                .items {
                    margin-bottom: 0;
                }

                .items .item {
                    display: flex;
                    justify-content: space-between;
                }

                .footer {
                    text-align: center;
                    margin-top: 0;
                }

                table {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    font-size: 4mm;
                }

                .table-borderless {
                    border-collapse: collapse;
                }

                .table-borderless td,
                .table-borderless th {
                    border: none;
                    margin: 0;
                    padding: 0;
                }

                h2,
                p {
                    margin: 0;
                    padding: 0;
                }

                p {
                    font-size: 4mm;
                }

                .ttd {
                    width: 100%;
                    margin-top: 30px;
                }

                .ttd div {
                    width: 45%;
                    /* Lebar masing-masing kolom 45% */
                    display: inline-block;
                    vertical-align: top;
                }

                .ttd div p {
                    margin: 0;
                    padding: 0;
                    text-align: center;
                    /* Untuk memastikan teks berada di tengah */
                }

                .ttd div:first-child {
                    float: left;
                    /* Posisi kiri untuk Ketua RW */
                }

                .ttd div:last-child {
                    float: right;
                    /* Posisi kanan untuk Ketua RT */
                }

                .print-btn {
                    margin-top: 200px;
                    display: flex;
                    justify-content: center;
                }

                .print-btn button {
                    background-color: blue;
                    color: white;
                    border: none;
                    padding: 15px 30px;
                    font-size: 16px;
                    border-radius: 8px;
                    cursor: pointer;
                    transition: background-color 0.3s ease, box-shadow 0.3s ease;
                }

                .print-btn button:hover {
                    background-color: #45a049;
                    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
                }

                .print-btn button:active {
                    background-color: #388e3c;
                    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
                }



                @media print {
                    .print-btn {
                        display: none;
                    }
                }
            </style>
</head>

<body>
    <div class="receipt">
        <div class="center">
            <h2><b>PEMERINTAH KABUPATEN BREBES</b></h2>
            <h2><b>KECAMATAN PAGUYANGAN</b></h2>
            <h2><b>DESA CILIBUR</b></h2>
            <p>Jl. Atmosasmito Ds Cilibur - Paguyangan Kode POS: 52276</p>
        </div>

        <hr class="line">
        <div class="nomor">
            <p>Nomor Kode Desa</p>
            <p><b>33 29 042 010</b></p>
        </div>

        <div class="center">
            <h2 style="text-decoration: underline;"><b>SURAT PENGANTAR RT</b></h2>
            <p>Nomor: <?= $nomor_surat; ?></p>
        </div>
        <br>

        <p>Yang bertanda tangan dibawah ini Ketua RT <?= $dt_penduduk['rt']; ?> dan Ketua RW <?= $dt_penduduk['rw']; ?> Desa Cilibur menerangkan bahwa:</p>
        <table class="table-borderless">
            <tbody>
                <tr>
                    <td width="2%">1.</td>
                    <td width="33%">Nama</td>
                    <td width="1%">:</td>
                    <td><?= $dt_penduduk['nama']; ?></td>
                </tr>
                <tr>
                    <td width="1%">2.</td>
                    <td width="33%">Tempat tanggal lahir</td>
                    <td width="2%">:</td>
                    <td><?= $dt_penduduk['ttl']; ?></td>
                </tr>
                <tr>
                    <td width="1%">3.</td>
                    <td width="33%">Kewarganegaraan dan agama</td>
                    <td width="2%">:</td>
                    <td>Indonesia - <?= $dt_penduduk['agama']; ?></td>
                </tr>
                <tr>
                    <td width="1%">4.</td>
                    <td width="25%">Pekerjaan</td>
                    <td width="2%">:</td>
                    <td><?= $dt_penduduk['pekerjaan']; ?></td>
                </tr>
                <tr>
                    <td width="1%">5.</td>
                    <td width="25%">Alamat</td>
                    <td width="2%">:</td>
                    <td>Desa <?= $dt_penduduk['alamat'] ?> RT <?= $dt_penduduk['rt'] ?> RW <?= $dt_penduduk['rw'] ?></td>
                </tr>
                <tr>
                    <td width="1%">6.</td>
                    <td width="25%">Keperluan</td>
                    <td width="2%">:</td>
                    <td><?= $Kategori_surat; ?></td>
                </tr>
                <tr>
                    <td width="1%">7.</td>
                    <td width="25%">Berlaku mulai</td>
                    <td width="2%">:</td>
                    <td><?= $tanggal_indonesia; ?> sampai dengan selesai.</td>
                </tr>
                <tr>
                    <td width="1%">8.</td>
                    <td width="25%">Keterangan lain-lain</td>
                    <td width="2%">:</td>
                    <td><?= $keterangan_lain; ?></td>
                </tr>

            </tbody>
        </table>
        <br>

        <p>Demikian untuk menjadikan maklum bagi yang berkepentingan.</p>
        <br>
        <p style="float: right;">Cilibur, <?= $tanggal_indonesia; ?></p>
        <div class="ttd">
            <div>
                <p>Ketua RW <?= $dt_penduduk['rw']; ?></p>
                <p style="margin-top: 30mm;"><?= $ketuaRW; ?></p>
            </div>
            <div>
                <p>Ketua RT <?= $dt_penduduk['rt']; ?> RW <?= $dt_penduduk['rw']; ?></p>
                <p style="margin-top: 30mm;"><?= $ketuaRT; ?></p>
            </div>
        </div>
<?php
        }
    }
?>
<!-- Tombol Cetak -->
<div class="print-btn">
    <button onclick="window.print()">Cetak</button>
</div>
    </div>
</body>

</html>