<table>
    <thead>
        <tr>
            <!-- Logo placeholder or company info -->
            <th colspan="7" style="font-weight: bold; font-size: 20px; text-align: center;">CARIBBEAN PORT SUPPLY</th>
        </tr>
        <tr>
            <th colspan="7"
                style="font-weight: bold; font-size: 14px; text-align: center; color: #000080; text-decoration: underline;">
                SHIP CHANDLER</th>
        </tr>
        <tr>
            <th colspan="7" style="font-style: italic; text-align: center; color: #000080;">"Supplying the Caribbean One
                Vessel at a Time"</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; color: #000080;">Phone: +502 4919-1164 / +502 5371-8796</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; color: #000080;">supply@caribbeanps.com.gt //
                m.burgos@caribbeanps.com.gt</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; text-decoration: underline;">QUOTATION
                #{{ $order->id }}</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="7" style="border: 2px solid #000000; font-weight: bold;">
                VESSEL NAME: <span style="color: #000080; margin-right: 20px;">{{ $order->vessel_name ?? 'N/A' }}</span>
                MASTER NAME: <span style="color: #000080;">{{ $order->captain_name }}</span>
            </th>
        </tr>
        <tr>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 50px;">No.</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 150px;">CATEGORY</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 300px;">PRODUCTS</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 80px;">UNIT</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 80px;">QTY</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 100px;">UNIT PRICE</th>
            <th style="border: 1px solid #000000; font-weight: bold; text-align: center; width: 100px;">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $index => $item)
            <tr>
                <td style="border: 1px solid #000000; text-align: right;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ $item->product->category->name ?? 'N/A' }}</td>
                <td style="border: 1px solid #000000;">{{ $item->product->name }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $item->product->unit ?? 'UNIT' }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $item->quantity }}</td>
                <td style="border: 1px solid #000000; text-align: right;">${{ number_format($item->unit_price, 2) }}</td>
                <td style="border: 1px solid #000000; text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach

        @for($i = 0; $i < 3; $i++)
            <tr>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
            </tr>
        @endfor

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid #000000; color: red; text-align: right; font-weight: bold;">Sub-Total</td>
            <td style="border: 1px solid #000000; background-color: #FFFF00; font-weight: bold; text-align: right;">
                ${{ number_format($order->total, 2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid #000000; color: red; text-align: right; font-weight: bold;">Discount
                {{ $order->discount_percentage > 0 ? $order->discount_percentage . ' %' : '' }}</td>
            <td style="border: 1px solid #000000; background-color: #FFFF00; font-weight: bold; text-align: right;">
                ${{ number_format($order->discount, 2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid #000000; color: red; text-align: right; font-weight: bold;">Sub-Total</td>
            <td style="border: 1px solid #000000; background-color: #FFFF00; font-weight: bold; text-align: right;">
                ${{ number_format($order->total - $order->discount, 2) }}</td>
        </tr>
        @if($order->tax > 0 || $order->shipping_cost > 0)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border: 1px solid #000000; color: red; text-align: right; font-weight: bold;">Tax & Shipping</td>
                <td style="border: 1px solid #000000; background-color: #FFFF00; font-weight: bold; text-align: right;">
                    ${{ number_format($order->tax + $order->shipping_cost, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border: 1px solid #000000; color: red; text-align: right; font-weight: bold;">Grand Total</td>
                <td style="border: 1px solid #000000; background-color: #FFFF00; font-weight: bold; text-align: right;">
                    ${{ number_format($order->total - $order->discount + $order->tax + $order->shipping_cost, 2) }}</td>
            </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center; margin-top: 20px;">
    Thank you for choosing Caribbean Port Supply
</div>