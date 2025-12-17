<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Provisions List</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            margin-top: 20px;
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
            <div class="quotation-title">PROVISIONS LIST</div>
            <div class="company-sub">SHIP CHANDLER</div>
            <div class="slogan">"Supplying the Caribbean One Vessel at a Time"</div>
            <div class="contact-info">
                Phone: +502 4919-1164 / +502 5371-8796<br>
                <a href="mailto:supply@caribbeanps.com.gt">supply@caribbeanps.com.gt</a> // <a href="mailto:m.burgos@caribbeanps.com.gt">m.burgos@caribbeanps.com.gt</a>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No.</th>
                <th>CATEGORY</th>
                <th>PRODUCTS</th>
                <th style="width: 60px;">UNIT</th>
                <th style="width: 80px;">PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td class="text-right">{{ $index + 1 }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->name }}</td>
                <td class="text-center">{{ $product->unit ?? 'UNIT' }}</td>
                <td class="text-right">$ {{ number_format($product->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Thank you for choosing Caribbean Port Supply
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <img src="{{ public_path('Img/Firma.png') }}" style="width: 150px;" alt="Signature">
    </div>

</body>
</html>
