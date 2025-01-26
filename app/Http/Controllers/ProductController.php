<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }    

    public function listProducts() 
    {
        $products = Product::all();
        return view('pages.admin.products', compact('products'));
    }
}
