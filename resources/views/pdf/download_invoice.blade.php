<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaksi->kode_transaksi }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #f6c5cb; /* soft pink */
            --primary-soft: #fdecef;
            --primary-dark: #e69aa0;
            --success: #a3d9c6; /* mint */
            --success-light: #e6f4f1;
            --gray-light: #fcf9f6; /* pastel beige */
            --gray: #f0eae2;
            --text-dark: #3f3f3f;
            --text-medium: #6b6b6b;
            --text-light: #a1a1a1;
            --shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            background: #fff;
            max-width: 860px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .invoice-header,
        .invoice-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--gray);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-placeholder {
            background: var(--primary);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: white;
            font-weight: 700;
        }

        .invoice-title {
            font-size: 2.25rem;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .invoice-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .customer-section, .payment-section {
            background: var(--gray-light);
            border: 1px solid var(--gray);
            padding: 1.5rem;
            border-radius: 10px;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        .status-badge {
            background: var(--success-light);
            color: var(--success);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .items-table thead {
            background: var(--primary-soft);
        }

        .items-table th,
        .items-table td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--gray);
        }

        .items-table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .items-table td {
            color: var(--text-medium);
        }

        .summary-section {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .totals-section {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid var(--gray);
            max-width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .total-row:last-child {
            border-top: 1px dashed var(--gray);
            padding-top: 1rem;
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .invoice-footer {
            border-top: 1px solid var(--gray);
            padding-top: 1rem;
            margin-top: 2rem;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .footer-item {
            flex: 1;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <p>food Delivery • Waled, Kabupaten Cirebon, 45187</p>
        <p>Invoice #{{ $transaksi->kode_transaksi }} • Issued: {{ $transaction->tanggal_dibayar->format('F j, Y') }}</p>
    </div>

    <div class="info-row">
        <div class="info-box">
            <div class="info-title">BILLED TO</div>
            <div class="info-content">
                <p><strong>{{ $transaksi->nama_customer ?? 'Customer Name' }}</strong></p>
                <p>Adress : {{ $transaksi->alamat ?? '123 Customer Street' }}</p>
                <p>Phone : {{ $transaksi->no_telp ?? '(123) 456-7890' }}</p>
                <p>ID Customer : {{ $transaksi->kode_customer }}</p>
            </div>
        </div>
        
        <div class="info-box">
            <div class="info-title">PAYMENT STATUS</div>
            <div class="info-content">
                <p style="color:green"><strong>PAID</strong></p>
                <p>Method : Cash</p>
                <p>Paid On : {{ $transaksi->tanggal_dibayar->format('M j, Y') }}</p>
                <p>Invoice #{{ $transaksi->kode_transaksi }}</p>
            </div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-center">Unit Price</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaksi->nama_produk }}</td>
                <td class="text-center">Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $transaksi->quantity }}</td>
                <td class="text-right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table class="total-table">
        <tr>
            <td class="grand-total">Total:</td>
            <td class="grand-total text-right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your business! • Payment due upon receipt</p>
        <p>Contact: antaresdiecast@company.com</p>
    </div>
</body>
</html>