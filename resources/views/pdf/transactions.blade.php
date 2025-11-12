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
            position: relative;
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
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
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
        tbody td:nth-child(3),
        tbody td:nth-child(4) {
            text-align: left;
            max-width: 250px;
            word-wrap: break-word;
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
                <th>Customer</th>
                <th>Produk</th>
                <th>Quantity</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->kode_transaksi }}</td>
                    <td>{{ $transaction->customer->nama_customer ?? '-' }}</td>
                    <td>{{ $transaction->product->nama_produk ?? '-' }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ optional($transaction->tanggal_dibayar)->format('d-m-Y') ?? 'Belum dibayar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-kanan">
        <span class="dicetak">Dicetak oleh: admin</span><br>
        <span class="sistem">Sistem Penjualan</span>
    </div>
</body>
</html>
