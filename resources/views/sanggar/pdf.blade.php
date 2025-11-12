<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Sanggar / Komunitas</title>
    <style>
        @page {
            size: A3 landscape; /* ✅ Lebih lebar agar tidak kepotong */
            margin: 25px;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #000;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* ✅ Supaya lebar kolom proporsional */
            word-wrap: break-word;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: center;
            vertical-align: middle;
        }

        thead {
            background-color: #d3d3d3;
            font-weight: bold;
        }

        th[colspan] {
            text-align: center;
        }

        .small-text {
            font-size: 9px;
        }

        .no {
            width: 3%;
        }

        /* Lebar kolom biar tidak menumpuk */
        .nama { width: 15%; }
        .alamat { width: 10%; }
        .desa { width: 10%; }
        .kec { width: 10%; }
        .no-sk { width: 8%; }
        .tahun { width: 6%; }
        .jabatan { width: 10%; }
        .pejabat { width: 10%; }
        .pimpinan { width: 10%; }
        .jk { width: 4%; }
        .nik { width: 10%; }
        .hp { width: 8%; }
        .anggota { width: 6%; }
        .bidang { width: 10%; }
        .status { width: 8%; }

                tr td:last-child,
        tr th:last-child {
            border-right: 1px solid #000 !important;
        }
    </style>
</head>
<body>
    <h2>DAFTAR SANGGAR, PADEPOKAN, KOMUNITAS DI PROVINSI JAWA BARAT</h2>
    <h3>KABUPATEN CIREBON</h3>

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2" class="nama">Nama Sanggar / Komunitas</th>
                <th colspan="3">Alamat</th>
                <th colspan="2">SK Pembuatan</th>
                <th colspan="2">Pejabat Penandatangan</th>
                <th colspan="4">Pimpinan Sanggar / Komunitas</th>
                <th rowspan="2" class="anggota">Jlh<br>Anggota</th>
                <th rowspan="2" class="bidang">Jenis / Bidang<br>Garapan Seni</th>
                <!-- <th rowspan="2" class="status">Status</th> -->
            </tr>
            <tr>
                <th class="alamat">Jalan / RT-RW</th>
                <th class="desa">Desa / Kelurahan</th>
                <th class="kec">Kecamatan</th>
                <th class="no-sk">No. SK</th>
                <th class="tahun">Tahun</th>
                <th class="jabatan">Jabatan</th>
                <th class="pejabat">Nama Pejabat</th>
                <th class="pimpinan">Nama</th>
                <th class="jk">L/P</th>
                <th class="nik">NIK</th>
                <th class="hp">No. HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sanggar as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->nama_sanggar }}</td>
                <td>{{ $item->jalan_rt_rw ?? '-' }}</td>
                <td>{{ $item->desa_kel ?? '-' }}</td>
                <td>{{ $item->kecamatan ?? '-' }}</td>
                <td>{{ $item->no_sk ?? '-' }}</td>
                <td>{{ $item->tahun_sk ?? '-' }}</td>
                <td>{{ $item->jabatan_penandatangan ?? '-' }}</td>
                <td>{{ $item->nama_penandatangan ?? '-' }}</td>
                <td>{{ $item->nama_pimpinan ?? '-' }}</td>
                <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                <td>{{ $item->nik ?? '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>{{ $item->jumlah_anggota ?? '-' }}</td>
                <td>{{ $item->bidang_garapan_seni ?? '-' }}</td>
                <!-- <td>{{ $item->status ?? '-' }}</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
