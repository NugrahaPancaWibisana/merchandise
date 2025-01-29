<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class Kasir extends Controller
{
    public function dashboard(): View
    {
        $products = Product::all();
        return view('pages.kasir.dashboard', compact( 'products'));
    }
}
