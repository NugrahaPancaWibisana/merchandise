<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\View\View;

class Owner extends Controller
{
    public function dashboard(): View
    {
        $log = Log::whereDate('created_at', Carbon::today())->count();
        $logs = Log::all();
        $product = Product::all()->count();
        $transaction = Transaction::all()->count();
        $transactionToday = Transaction::whereDate('created_at', Carbon::today())->count();

        return view('pages.owner.dashboard', compact('log', 'logs', 'product', 'transaction', 'transactionToday'));
    }
}
