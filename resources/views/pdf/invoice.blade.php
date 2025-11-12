<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaksi->kode_transaksi }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #b3e5fc;
            --primary-dark: #03a9f4;
            --gray-light: #f4f7f9;
            --gray: #e0e0e0;
            --text-dark: #333;
            --text-light: #777;
            --success: #81c784;
            --warning: #ffb74d;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-light);
            color: var(--text-dark);
            margin: 0;
            padding: 2rem;
        }

        .invoice-container {
            max-width: 800px;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin: auto;
        }

        .invoice-header, .invoice-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--gray);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .logo-placeholder {
            background: var(--primary-dark);
            color: #fff;
            padding: 0.7rem 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            font-size: 1.25rem;
        }

        .company-info h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .invoice-title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .invoice-grid {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .customer-section, .payment-section {
            flex: 1;
            background: var(--gray-light);
            padding: 1.5rem;
            border-radius: 10px;
        }

        .section-title {
            font-size: 1.1rem;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            background-color: var(--success);
            color: #fff;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .items-table th, .items-table td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid var(--gray);
        }

        .items-table th {
            background: var(--primary);
            color: #fff;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .invoice-footer {
            border-top: 1px solid var(--gray);
            padding-top: 1rem;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .footer-item {
            flex: 1;
            text-align: center;
        }

        .footer-item-title {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="logo-section">
                <div class="logo-placeholder">P3</div>
                <div class="company-info">
                    <h2>Laundry</h2>
                    <p>Jl. Bersih No. 8, Cirebon</p>
                </div>
            </div>
            <div class="invoice-meta">
                <div class="invoice-title">INVOICE</div>
                <div>#{{ $transaksi->kode_transaksi }}</div>
                <div>Issued: {{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('F j, Y') }}</div>
            </div>
        </div>

<!-- Customer & Payment -->
<div class="invoice-grid">
    <div class="customer-section">
        <div class="section-title">Customer Info</div>
        <!-- Nama customer dihapus -->
        <div>Address: {{ $transaksi->pesanan->alamat ?? '-' }}</div>
        <div>Phone: {{ $transaksi->pesanan->no_telp ?? '-' }}</div>
        <div>ID: {{ $transaksi->pesanan->kode_customer ?? '-' }}</div>
    </div>

    <div class="payment-section">
        <div class="section-title">Payment Status</div>
        <div class="status-badge">{{ strtoupper($transaksi->status_bayar) }}</div>
        <div>Method: <strong>{{ ucfirst($transaksi->metode_bayar) }}</strong></div>
        <div>Paid on: {{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('F j, Y') }}</div>
    </div>
</div>


        <!-- Items Table -->
        <div class="items-container">
            <div class="section-title">Laundry Details</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $transaksi->pesanan->nama_produk ?? '-' }}</td>
                        <td class="text-center">Rp {{ number_format($transaksi->pesanan->harga ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $transaksi->pesanan->quantity ?? 0 }}</td>
                        <td class="text-center">Rp {{ number_format($transaksi->pesanan->total_harga ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-item">
                <div class="footer-item-title">Payment Terms</div>
                <div>Payment due on completion</div>
            </div>
            <div class="footer-item">
                <div class="footer-item-title">Contact Us</div>
                <div>support@cleanwash.com</div>
            </div>
            <div class="footer-item">
                <div class="footer-item-title">Thank You</div>
                <div>Thanks for trusting CleanWash!</div>
            </div>
        </div>
    </div>
</body>
</html>
