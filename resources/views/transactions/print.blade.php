<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->id }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 14px; max-width: 300px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .title { font-size: 20px; font-weight: bold; margin: 0; text-transform: uppercase; }
        .meta { margin-bottom: 10px; font-size: 12px; }
        .item-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .total-row { border-top: 2px dashed #000; margin-top: 10px; padding-top: 10px; display: flex; justify-content: space-between; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; border-top: 1px dotted #000; padding-top: 10px; }
        .badge { border: 1px solid #000; padding: 2px 4px; font-size: 10px; font-weight: bold; margin-right: 5px; }
        @media print { body { margin: 0; padding: 0; } @page { size: 80mm auto; margin: 0; } }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1 class="title">Mie Gamon</h1>
        <p>Jl. Kenangan Mantan No. 12</p>
    </div>

    <div class="meta">
        <div>Tgl: {{ $transaction->created_at->format('d/m/Y H:i') }}</div>
        <div>No: #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</div>
        <div>Kasir: {{ $transaction->user->name }}</div>
        <div>Plg: <strong>{{ $transaction->customer_name }}</strong></div>
        
        <div style="margin-top: 8px; text-align: center;">
            <span class="badge">{{ $transaction->order_type == 'dine_in' ? 'DINE IN' : 'TAKE AWAY' }}</span>
            <span class="badge">{{ strtoupper($transaction->payment_method) }}</span>
            @if($transaction->order_type == 'dine_in')
                <div style="margin-top: 5px; font-weight: bold;">MEJA: {{ $transaction->table_number }}</div>
            @endif
        </div>
    </div>

    <div style="border-bottom: 2px dashed #000; margin-bottom: 10px;"></div>

    <div class="items">
        @php 
            $grandTotal = 0; 
            $originalTotal = 0;
        @endphp
        @foreach($items as $item)
            @php 
                $grandTotal += $item->total_price;
                $originalTotal += $item->product->price * $item->quantity;
            @endphp
            <div class="item-row">
                <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
            </div>
            <div class="item-row" style="justify-content: flex-end;">
                <span>Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>

    <div class="total-row" style="display: block; border-top: 2px dashed #000;">
        @if($originalTotal > $grandTotal)
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: normal;">
                <span>Subtotal</span>
                <span>Rp {{ number_format($originalTotal, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: normal;">
                <span>Diskon</span>
                <span>-Rp {{ number_format($originalTotal - $grandTotal, 0, ',', '.') }}</span>
            </div>
            <div style="border-bottom: 1px dashed #000; margin-bottom: 5px;"></div>
        @endif
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 16px;">
            <span>TOTAL</span>
            <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Terima Kasih!</p>
    </div>
</body>
</html>