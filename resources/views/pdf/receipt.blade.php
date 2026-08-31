<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body, * {
            font-family: 'Cairo', sans-serif !important;
            direction: rtl !important;
            text-align: right !important;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        .receipt-wrapper {
            width: 100%;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            background: #fff;
            overflow: hidden;
        }

        /* مسافة حول صورة الهيدر */
        .header-image-container {
            padding: 24px 24px 0;
        }

        .receipt-header {
            background-image: url('{{ public_path('home-assets/images/header.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 16px;
            color: #fff;
            padding: 40px;
            min-height: 140px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .receipt-header > * {
            position: relative;
            z-index: 1;
        }

        .receipt-header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        }

        .receipt-header h1 .en {
            display: block;
            font-size: 13px;
            font-weight: 600;
            opacity: 1;
            color: #ffffff;
            margin-top: 3px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        .receipt-header .sub {
            font-size: 12px;
            opacity: 0.95;
            margin-top: 8px;
            font-weight: 500;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 7px 18px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            backdrop-filter: blur(4px);
            text-align: center;
        }

        .status-badge .row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4ade80;
            display: inline-block;
        }

        .status-badge .en-label {
            font-size: 10px;
            font-weight: 600;
            opacity: 1;
            color: #ffffff;
        }

        /* Info grid */
        .info-grid {
            display: flex;
            flex-wrap: wrap;
            padding: 28px 40px;
            border-bottom: 1px solid #f5e5e7;
        }

        .info-item {
            flex: 1;
            min-width: 150px;
            padding-inline-end: 20px;
        }

        .info-item .label {
            font-size: 11.5px;
            color: #9891a0;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .info-item .label .en {
            font-size: 10.5px;
            color: #746f78;
            font-weight: 600;
        }

        .info-item .value {
            font-size: 15.5px;
            font-weight: 700;
            color: #2b2632;
        }

        /* Section */
        .section {
            padding: 26px 40px;
        }

        .section-title {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 16px;
        }

        .section-title .bar {
            width: 4px;
            height: 16px;
            background: #E20512;
            border-radius: 3px;
            align-self: center;
        }

        .section-title h2 {
            font-size: 14.5px;
            color: #E20512;
            font-weight: 700;
            margin: 0;
        }

        .section-title h2 .en {
            font-size: 12px;
            font-weight: 600;
            color: #b23a44;
            margin-inline-start: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
        }

        thead th {
            background: #fdf1f2;
            color: #776f75;
            padding: 12px 14px;
            text-align: right;
            font-weight: 700;
            font-size: 12px;
            border-bottom: 2px solid #f5c3c7;
        }

        thead th .en {
            display: block;
            font-size: 10.5px;
            font-weight: 600;
            color: #776f75;
            margin-top: 2px;
        }

        tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid #f7eeef;
            color: #3a3542;
            font-weight: 500;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Total box */
        .total-box {
            background: linear-gradient(135deg, #fdf1f2, #fbe0e2);
            border: 1px solid #f5c3c7;
            border-radius: 14px;
            padding: 22px 30px;
            margin: 10px 40px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-box .total-label {
            font-size: 14px;
            font-weight: 600;
            color: #5b5563;
        }

        .total-box .total-label .en {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: #776f75;
            margin-top: 2px;
        }

        .total-box .amount {
            font-size: 26px;
            font-weight: 800;
            color: #E20512;
        }

        /* Footer */
        .receipt-footer {
            padding: 22px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f5e5e7;
            font-size: 11.5px;
            color: #a29ca9;
        }

        .receipt-footer .footer-note {
            font-size: 10.5px;
            color: #a89ea1;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="receipt-wrapper">

    <div class="header-image-container">
        <div class="receipt-header">

        </div>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="label">استلمنا من <span class="en">/ Received From</span></div>
            <div class="value">{{ $receipt->user->name ?? $data->User?->name ?? 'فاعل خير' }}</div>
        </div>
        <div class="info-item">
            <div class="label">رقم الهاتف <span class="en">/ Phone No.</span></div>
            <div class="value">{{ $receipt->user->phone ?? $data->User?->phone ?? '—' }}</div>
        </div>
        <div class="info-item">
            <div class="label">التاريخ <span class="en">/ Date</span></div>
            <div class="value">{{ $receipt->date }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            <span class="bar"></span>
            <h2>سند القبض <span class="en">/ Receipt Voucher</span></h2>
        </div>
        <table>
            <thead>
            <tr>
                <th>رقم السند<span class="en">Receipt No.</span></th>
                <th>طريقة الدفع<span class="en">Payment Method</span></th>
                <th>المبلغ<span class="en">Amount</span></th>
                <th>التاريخ<span class="en">Date</span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $receipt->no }}</td>
                <td>{{ $receipt->payment_method?->value ?? '—' }}</td>
                <td>{{ number_format($receipt->amount, 3) }} د.ب</td>
                <td>{{ $receipt->date }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">
            <span class="bar"></span>
            <h2>تفاصيل القبض <span class="en">/ Receipt Details</span></h2>
        </div>
        <table>
            <thead>
            <tr>
                <th>الرقم<span class="en">No.</span></th>
                <th>البيان<span class="en">Description</span></th>
                <th>المبلغ<span class="en">Amount</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->items as $item)
                <tr>
                    <td>{{ $item->project?->no }}</td>
                    <td>{{ $item->project?->name }}</td>
                    <td>{{ number_format($item->amount, 3) }} د.ب</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="total-box">
        <span class="total-label">
            إجمالي المبلغ
            <span class="en">Total Amount</span>
        </span>
        <span class="amount">{{ number_format($data->amount, 3) }} د.ب</span>
    </div>

    <div class="receipt-footer">
        <span>الموقع الإلكتروني <span style="color:#a89ea1;">/ Website</span></span>
        <span class="footer-note">{{ now()->format('Y-m-d H:i') }}</span>
    </div>

</div>

</body>
</html>
