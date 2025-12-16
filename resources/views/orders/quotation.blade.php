<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $order->id }}</title>
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
            width: 100px; /* Adjust as needed */
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #000; /* Or dark blue */
            text-transform: uppercase;
        }
        .company-sub {
            font-size: 16px;
            font-weight: bold;
            color: #000080; /* Navy Blue */
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
        .quotation-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .vessel-info {
            width: 100%;
            border: 2px solid #000;
            margin-bottom: 0; /* Connected to table */
            padding: 5px;
            font-weight: bold;
        }
        .vessel-info span {
            margin-right: 20px;
        }
        .vessel-val {
            color: #000080;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            border-top: none; /* Connected to vessel info */
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
        }
        th {
            background-color: #fff;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        
        .total-row td {
            background-color: #fff;
        }
        .grand-total {
            background-color: #ffff00; /* Yellow highlight */
            font-weight: bold;
        }
        .red-text { color: red; }
        
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
            <div class="quotation-title">QUOTATION</div>
            <div class="company-sub">SHIP CHANDLER</div>
            <div class="slogan">"Supplying the Caribbean One Vessel at a Time"</div>
            <div class="contact-info">
                Phone: +502 4919-1164 / +502 5371-8796<br>
                <a href="mailto:supply@caribbeanps.com.gt">supply@caribbeanps.com.gt</a> // <a href="mailto:m.burgos@caribbeanps.com.gt">m.burgos@caribbeanps.com.gt</a>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="vessel-info">
        VESSEL NAME: <span class="vessel-val">{{ $order->vessel_name ?? 'N/A' }}</span>
        MASTER NAME: <span class="vessel-val">{{ $order->captain_name }}</span>
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
                <td></td><td></td><td></td><td></td><td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Sub-Total</td>
                <td class="text-right grand-total">$ {{ number_format($order->total, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td></td><td></td><td></td><td></td><td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Discount {{ $order->discount_percentage > 0 ? $order->discount_percentage . ' %' : '' }}</td>
                <td class="text-right grand-total">$ {{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td></td><td></td><td></td><td></td><td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Sub-Total</td>
                <td class="text-right grand-total">$ {{ number_format($order->total - $order->discount, 2) }}</td>
            </tr>
             @if($order->tax > 0 || $order->shipping_cost > 0)
             <tr class="total-row">
                <td></td><td></td><td></td><td></td><td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Tax & Shipping</td>
                <td class="text-right grand-total">$ {{ number_format($order->tax + $order->shipping_cost, 2) }}</td>
            </tr>
             <tr class="total-row">
                <td></td><td></td><td></td><td></td><td></td>
                <td class="text-right red-text" style="border: 1px solid #000;">Grand Total</td>
                <td class="text-right grand-total">$ {{ number_format($order->total - $order->discount + $order->tax + $order->shipping_cost, 2) }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Thank you for choosing Caribbean Port Supply
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <img src="{{ public_path('Img/Firma.png') }}" style="width: 150px;" alt="Signature">
        <div style="display: inline-block; text-align: center; color: #555;">
             <!-- Optional text below signature if needed, but image might contain it -->
        </div>
    </div>

</body>
</html>
