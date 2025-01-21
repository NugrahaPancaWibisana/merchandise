<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class Admin extends Controller
{
    public function dashboard(): View
    {
        $user = User::all()->count();
        $product = Product::all()->count();
        return view('pages.admin.dashboard', compact('user', 'product'));
    }
}
