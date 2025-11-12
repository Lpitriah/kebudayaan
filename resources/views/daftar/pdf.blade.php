<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Nomor Induk Kebudayaan (NIK)</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            color: #000;
            margin: 50px;
        }

        .kop { text-align: center; line-height: 1.4; margin-bottom: 15px; }
        .kop h3 { margin: 0; font-weight: bold; text-transform: uppercase; }
        .kop h4 { margin: 2px 0; font-weight: normal; }

        .judul {
            text-align: center;
            margin: 20px 0 15px 0;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: underline;
        }

        table { width: 100%; border-collapse: collapse; font-size: 12pt; margin-bottom: 10px; }
        td { border: 1px solid #000; padding: 6px 8px; vertical-align: top; }
        .label { width: 35%; font-weight: bold; }

        .catatan { font-size: 11pt; margin-top: 15px; text-align: justify; }

        .ttd { width: 100%; margin-top: 25px; }
        .ttd td { border: none; text-align: left; vertical-align: bottom; }

        .photo {
            border: 1px solid #000;
            width: 4cm;
            height: 6cm;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 11pt;
        }

        .photo img {
            width: 4cm;
            height: 6cm;
            object-fit: cover;
        }

        .right { text-align: right; }
    </style>
</head>
<body>

    <div class="kop">
        <h3>KOP DINAS KEBUDAYAAN DAN PARIWISATA</h3>
        <h4>KABUPATEN CIREBON</h4>
    </div>

    <div class="judul">
        KARTU NOMOR INDUK KEBUDAYAAN (NIK)<br>
        <span style="text-transform:none;">Sanggar / Komunitas / Padepokan</span>
    </div>

    <table>
        <tr>
            <td class="label">Nomor Induk Kebudayaan (NIK)</td>
            <td>{{ $sanggar->nomor_induk_kebudayaan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nama Kelompok Budaya</td>
            <td>{{ $sanggar->nama_sanggar ?? '-' }}</td>
        </tr>
        <tr>
            <td>Bidang Kegiatan</td>
            <td>{{ $sanggar->bidang_garapan_seni ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat Sekretariat</td>
            <td>{{ $sanggar->jalan_rt_rw ?? '-' }}, {{ $sanggar->desa ?? '-' }}, {{ $sanggar->kecamatan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Ketua Kelompok</td>
            <td>{{ $sanggar->nama_pimpinan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tahun Berdiri</td>
            <td>{{ $sanggar->tahun_berdiri ?? '-' }}</td>
        </tr>
        <tr>
            <td>Masa Berlaku</td>
            <td>Oktober 2025 – Oktober 2027</td>
        </tr>
        <tr>
            <td>Status Legalitas</td>
            <td>{{ $sanggar->status ?? 'Terdaftar dan Diakui oleh Dinas Kebudayaan' }}</td>
        </tr>
        <tr>
            <td>Tanggal Terbit</td>
            <td>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <p class="catatan">
        <strong>Catatan:</strong> Pemegang kartu ini wajib menyampaikan laporan kegiatan budaya setiap 6 (enam) bulan kepada Dinas Kebudayaan Kabupaten Cirebon.
    </p>

    <table class="ttd">
        <tr>
            <td>
                Ditetapkan oleh,<br>
                Kepala Dinas Kebudayaan dan Pariwisata<br>
                Kabupaten Cirebon<br><br><br><br>
                <u><strong>Nama Kepala Dinas</strong></u><br>
                NIP. 1234567890
            </td>
            <td class="right">
                <div class="photo">
                    @if($sanggar->foto)
                        <img src="{{ public_path('storage/' . $sanggar->foto) }}" alt="Foto Sanggar">
                    @else
                        Pas Photo<br>4 x 6 cm
                    @endif
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
