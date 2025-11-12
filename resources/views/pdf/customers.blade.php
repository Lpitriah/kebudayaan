<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Pelanggan - Cetak PDF</title>
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
            position: relative;
        }
        h5 {
            font-weight: 600;
            color: #0ea5e9;
            margin-bottom: 5px;
            font-size: 18px;
            text-align: center;
        }
        .tanggal-cetak {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            color: #38bdf8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }
        thead {
            background-color: #0284c7;
        }
        thead th {
            color: white;
            padding: 12px 15px;
            font-size: 12px;
            text-transform: uppercase;
            text-align: center;
            border: none;
        }
        tbody tr {
            border-bottom: 1px solid #ddd;
        }
        tbody tr:nth-child(odd) {
            background-color: #fff;
        }
        tbody tr:nth-child(even) {
            background-color: #e0f7ff;
        }
        tbody td {
            padding: 12px 15px;
            font-size: 11px;
            color: #000;
            text-align: center;
            word-wrap: break-word;
        }
        /* Tambahan: Kode customer ditebalkan */
        td.kode-customer {
            font-weight: bold;
            color: #000;
        }
        td:nth-child(4),
        td:nth-child(5) { /* alamat kolom 5 */
            text-align: left;
            max-width: 250px;
            word-wrap: break-word;
        }
        .footer-kanan {
            margin-top: 30px;
            font-size: 12px;
            text-align: right;
        }
        .footer-kanan .dicetak {
            color: #38bdf8;
        }
        .footer-kanan .sistem {
            color: #0284c7;
        }
    </style>
</head>
<body>

<h5><i class="fas fa-users me-2"></i>Laporan Data Customer</h5>
<div class="tanggal-cetak">
    Tanggal Cetak: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Customer</th>
            <th>Kontak</th>
            <th>Alamat</th>
            <th>Tanggal</th> <!-- Kolom tanggal jam di kanan -->
        </tr>
    </thead>
    <tbody>
        @forelse($customers as $customer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="kode-customer">{{ $customer->kode_customer }}</td>
            <td>{{ $customer->nama_customer }}</td>
            <td>{{ $customer->no_telp ?? '-' }}</td>
            <td>{{ $customer->alamat }}</td>
            <td>{{ \Carbon\Carbon::parse($customer->created_at)->locale('id')->translatedFormat('d F Y H:i:s') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center; padding:20px;">
                Tidak ada data customer.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="footer-kanan">
    <span class="dicetak">Dicetak oleh: admin</span><br>
    <span class="sistem">Sistem Penjualan</span>
</div>

</body>
</html>
