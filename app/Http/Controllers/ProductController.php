<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createProductView()
    {
        return view('pages.admin.create-product');
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'nama_product' => ['required', 'string', 'max:255'],
            'harga_product' => ['required', 'numeric'],
        ]);

        $product = Product::create($request->all());


        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Menambahkan produk: {$product->nama_product}",
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProductView(Product $product)
    {
        return view('pages.admin.edit-product', compact('product'));
    }

    public function editProduct(Request $request, Product $product)
    {
        $request->validate([
            'nama_product' => ['required', 'string', 'max:255'],
            'harga_product' => ['required', 'numeric'],
        ]);

        $oldName = $product->nama_product;
        $product->update($request->all());

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Mengubah produk dari '{$oldName}' menjadi '{$product->nama_product}'",
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct(Product $product)
    {
        $productName = $product->nama_product;
        $product->delete();

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Menghapus produk: {$productName}",
        ]);


        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function listProducts()
    {
        $products = Product::all();

        if (Auth::user()->role == 'ADMIN') {
            return view('pages.admin.products', compact('products'));
        }

        if (Auth::user()->role == 'OWNER') {
            return view('pages.owner.products', compact('products'));
        }
    }
}
