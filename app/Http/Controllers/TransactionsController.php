<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function listTransactions(Request $request)
    {
        $query = Transaction::with('items.product');

        if ($request->has(['start_date', 'end_date']) && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $transactions = $query->get();

        return view('pages.owner.transactions', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:45',
            'uang_bayar' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->nama_product} tidak mencukupi");
                }

                if (!$product->harga_product || $product->harga_product <= 0) {
                    throw new \Exception("Harga produk {$product->nama_product} tidak valid");
                }

                $total += $product->harga_product * $item['quantity'];
            }

            $transaction = Transaction::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'nomor_unik' => 'TRX-' . time(),
                'uang_bayar' => $request->uang_bayar,
                'uang_kembali' => $request->uang_bayar - $total,
            ]);

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                TransactionItems::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->harga_product,
                    'subtotal' => $product->harga_product * $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Transaksi berhasil! ' . $transaction->nomor_unik,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil',
                'transaction' => $transaction->load('items.product'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function print($id)
    {
        $transaction = Transaction::with(['items.product'])->findOrFail($id);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Print transaksi berhasil! ' . $transaction->nomor_unik,
        ]);

        return view('pages.kasir.print', compact('transaction'));
    }
}
