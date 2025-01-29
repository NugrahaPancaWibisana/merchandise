<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function listTransactions(Request $request)
    {
        $query = Transaction::with('product');

        if ($request->has(['start_date', 'end_date']) && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $transactions = $query->get();

        return view('pages.owner.transactions', compact('transactions'));
    }

    public function tambahKeKeranjang(Request $request)
    {
        $produk = Product::find($request->id_produk);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$request->id_produk])) {
            $keranjang[$request->id_produk]['jumlah']++;
        } else {
            $keranjang[$request->id_produk] = [
                'nama' => $produk->nama_product,
                'jumlah' => 1,
                'harga' => $produk->harga_product,
                'total' => $produk->harga_product
            ];
        }

        session()->put('keranjang', $keranjang);

        return $this->hitungTotalKeranjang();
    }

    public function updateJumlah(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$request->id_produk])) {
            if ($request->aksi === 'tambah') {
                $keranjang[$request->id_produk]['jumlah']++;
            } else if ($request->aksi === 'kurang') {
                $keranjang[$request->id_produk]['jumlah']--;
                if ($keranjang[$request->id_produk]['jumlah'] <= 0) {
                    unset($keranjang[$request->id_produk]);
                }
            }

            if (isset($keranjang[$request->id_produk])) {
                $keranjang[$request->id_produk]['total'] = $keranjang[$request->id_produk]['harga'] * $keranjang[$request->id_produk]['jumlah'];
            }
        }

        session()->put('keranjang', $keranjang);

        return $this->hitungTotalKeranjang();
    }

    public function ambilKeranjang()
    {
        return $this->hitungTotalKeranjang();
    }

    private function hitungTotalKeranjang()
    {
        $keranjang = session()->get('keranjang', []);
        $subtotal = 0;
        $pajak = 0;

        foreach ($keranjang as $item) {
            $subtotal += $item['harga'] * $item['jumlah'];
            $pajak += ($item['harga'] * 0.12) * $item['jumlah']; // Pajak 12% per item
        }

        $total = $subtotal + $pajak;

        return response()->json([
            'keranjang' => $keranjang,
            'subtotal' => $subtotal,
            'pajak' => $pajak,
            'total' => $total,
            'keranjangHtml' => view('components.items-keranjang', compact('keranjang', 'subtotal', 'pajak', 'total'))->render()
        ]);
    }
}
