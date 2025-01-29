<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk', 'nama_pelanggan', 'nomor_unik', 'uang_bayar', 'uang_kembali'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
