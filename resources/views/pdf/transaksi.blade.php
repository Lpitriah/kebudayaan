<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }
        h2 {
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
            margin-top: 20px;
        }
        thead {
            background-color: #0284c7;
        }
        thead th {
            color: white;
            padding: 10px 12px;
            font-size: 12px;
            text-transform: uppercase;
            text-align: center;
        }
        tbody tr:nth-child(odd) {
            background-color: #fff;
        }
        tbody tr:nth-child(even) {
            background-color: #e0f7ff;
        }
        tbody td {
            padding: 10px 12px;
            font-size: 11px;
            text-align: center;
        }
        .footer-kanan {
            margin-top: 40px;
            font-size: 12px;
            text-align: right;
            color: #0284c7;
        }
        .dicetak {
            font-size: 12px;
            color: #38bdf8;
        }
        .sistem {
            font-size: 12px;
            color: #0284c7;
        }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <div class="tanggal-cetak">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Kode Pesanan</th>
                <th>Metode Bayar</th>
                <th>Status Bayar</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->kode_transaksi }}</td>
                    <td>{{ $transaction->kode_pesanan }}</td>
                    <td>{{ ucfirst($transaction->metode_bayar) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->status_bayar)) }}</td>
                    <td>
                        {{ $transaction->tanggal_bayar 
                            ? \Carbon\Carbon::parse($transaction->tanggal_bayar)->format('d-m-Y H:i') 
                            : 'Belum dibayar' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-kanan">
        <span class="dicetak">Dicetak oleh: admin</span><br>
        <span class="sistem">Sistem Transaksi Laundry</span>
    </div>
</body>
</html>
