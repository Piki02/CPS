<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px;
            /* Adjust as needed */
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            /* Or dark blue */
            text-transform: uppercase;
        }

        .company-sub {
            font-size: 16px;
            font-weight: bold;
            color: #000080;
            /* Navy Blue */
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .slogan {
            font-style: italic;
            color: #000080;
            margin-bottom: 5px;
        }

        .contact-info {
            color: #000080;
        }

        .contact-info a {
            color: #000080;
            text-decoration: none;
        }

        .invoice-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .bill-to-info {
            width: 100%;
            border: 2px solid #000;
            margin-bottom: 0;
            /* Connected to table */
            padding: 5px;
            /* font-weight: bold; */
        }

        .bill-to-row {
            margin-bottom: 2px;
        }

        .bill-to-label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
        }

        .bill-to-val {
            color: #000080;
            font-weight: bold;
        }

        .vessel-info {
            /* width: 100%; */
            /* border: 2px solid #000; */
            /* margin-bottom: 0; */
            /* padding: 5px; */
            /* font-weight: bold; */
            margin-top: 5px;
            border-top: 1px dashed #ccc;
            padding-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            border-top: none;
            /* Connected to bill-to info */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background-color: #fff;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .total-row td {
            background-color: #fff;
        }

        .grand-total {
            background-color: #ffff00;
            /* Yellow highlight */
            font-weight: bold;
        }

        .red-text {
            color: red;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('Img/Logo sin Fondo.png') }}" class="logo" alt="Logo" style="width: 120px;">

        <div style="float: right; width: 75%; text-align: center;">
            <div class="invoice-title">INVOICE #{{ $order->id }}</div>
            <div class="company-sub">SHIP CHANDLER</div>
            <div class="slogan">"Supplying the Caribbean One Vessel at a Time"</div>
            <div class="contact-info">
                Phone: +502 4919-1164 / +502 5371-8796<br>
                <a href="mailto:supply@caribbeanps.com.gt">supply@caribbeanps.com.gt</a> // <a
                    href="mailto:m.burgos@caribbeanps.com.gt">m.burgos@caribbeanps.com.gt</a>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="bill-to-info">
        <div class="bill-to-row">
            <span class="bill-to-label">Name:</span> <span
                class="bill-to-val">{{ $order->invoice_name ?? 'N/A' }}</span>
        </div>
        <div class="bill-to-row">
            <span class="bill-to-label">Address:</span> <span class="bill-to-val">{{ $order->invoice_address }}</span>
        </div>
        <div class="bill-to-row">
            <span class="bill-to-label">Phone:</span> <span class="bill-to-val">{{ $order->invoice_phone }}</span>
        </div>
        <div class="bill-to-row">
            <span class="bill-to-label">NIT:</span> <span class="bill-to-val">{{ $order->invoice_nit }}</span>
        </div>
        <div class="bill-to-row">
            <span class="bill-to-label">Zip Code:</span> <span class="bill-to-val">{{ $order->invoice_zip_code }}</span>
        </div>

        <div class="vessel-info" style="font-weight: bold;">
            VESSEL NAME: <span class="bill-to-val">{{ $order->vessel_name ?? 'N/A' }}</span>
            <span style="margin-left: 20px;">MASTER NAME:</span> <span
                class="bill-to-val">{{ $order->captain_name }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No.</th>
                <th>CATEGORY</th>
                <th>PRODUCTS</th>
                <th style="width: 40px;">UNIT</th>
                <th style="width: 40px;">QTY</th>
                <th style="width: 80px;">UNIT PRICE</th>
                <th style="width: 80px;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
                <tr>
                    <td class="text-right">{{ $index + 1 }}</td>
                    <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->product->unit ?? 'UNIT' }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">$ {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">$ {{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach

            <!-- Fill empty rows to maintain minimum height or structure -->
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor

            <tr class="total-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Sub-Total</td>
                <td class="text-right grand-total">$ {{ number_format($order->total, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Discount
                    {{ $order->discount_percentage > 0 ? $order->discount_percentage . ' %' : '' }}</td>
                <td class="text-right grand-total">$ {{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Sub-Total</td>
                <td class="text-right grand-total">$ {{ number_format($order->total - $order->discount, 2) }}</td>
            </tr>
            @if($order->tax > 0 || $order->shipping_cost > 0)
                <tr class="total-row">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right red-text" style="border: 1px solid #000;">Tax & Shipping</td>
                    <td class="text-right grand-total">$ {{ number_format($order->tax + $order->shipping_cost, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right red-text" style="border: 1px solid #000;">Grand Total</td>
                    <td class="text-right grand-total">$
                        {{ number_format($order->total - $order->discount + $order->tax + $order->shipping_cost, 2) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Thank you for choosing Caribbean Port Supply
    </div>

    <!-- No Signature section for Invoice -->

</body>

</html>