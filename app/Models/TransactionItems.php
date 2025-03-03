<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItems extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionItemsFactory> */
    use HasFactory;

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
