<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function createProductView()
    {
        $categories = \App\Models\Category::all();

        return view('pages.admin.create-product', compact('categories'));
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'nama_product' => ['required', 'string', 'max:255'],
            'harga_product' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        $product = Product::create([
            'image' => $imagePath,
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'nama_product' => ['required', 'string', 'max:255'],
            'harga_product' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        // Simpan gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        $oldName = $product->nama_product;
        $product->update([
            'image' => $imagePath,
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Mengubah produk dari '{$oldName}' menjadi '{$product->nama_product}'",
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct(Product $product)
    {
        // Hapus gambar dari storage jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

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
        $products = Product::where('stock', '>', 0)->get(); // Filter stock > 0

        if (Auth::user()->role == 'ADMIN') {
            return view('pages.admin.products', compact('products'));
        }

        if (Auth::user()->role == 'OWNER') {
            return view('pages.owner.products', compact('products'));
        }
    }
}
