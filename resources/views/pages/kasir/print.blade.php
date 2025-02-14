<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->nomor_unik }}</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.2;
            padding: 5mm;
            margin: 0;
            width: 70mm;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .header {
            margin-bottom: 10px;
        }

        .divider {
            border-top: 1px dotted #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
        }

        .items td {
            padding: 1px 0;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="text-center header">
        <div>NAMA TOKO</div>
        <div>Alamat Toko</div>
        <div>Telp: 081234567890</div>
    </div>

    <table>
        <tr>
            <td>No. Transaksi</td>
            <td>: {{ $transaction->nomor_unik }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ $transaction->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: {{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: {{ $transaction->nama_pelanggan }}</td>
        </tr>
    </table>

    <div class="divider"></div>
    <div>Items:</div>

    <table class="items">
        @foreach ($transaction->items as $item)
            <tr>
                <td colspan="3">{{ $item->product->nama_product }}</td>
            </tr>
            <tr>
                <td>{{ $item->quantity }} x</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="divider"></div>

    <table>
        <tr>
            <td>Total</td>
            <td class="text-right">Rp {{ number_format($transaction->items->sum('subtotal'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunai</td>
            <td class="text-right">Rp {{ number_format($transaction->uang_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp {{ number_format($transaction->uang_kembali, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="footer">
        <div>Terima kasih atas kunjungan Anda</div>
        <div>Barang yang sudah dibeli tidak dapat</div>
        <div>ditukar/dikembalikan</div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>