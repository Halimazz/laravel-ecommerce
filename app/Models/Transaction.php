<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'invoice_number',
        'amount',
        'status',
        'product_id',
        'user_id',
        'order_id',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke tabel product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
