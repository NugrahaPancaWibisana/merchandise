<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class Kasir extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->where('stock', '>', 0)->get();

        return view('pages.kasir.dashboard', compact('categories', 'products'));
    }
}
