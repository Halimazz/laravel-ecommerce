<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'is_paid',
        'payment_receipt',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Product (if using a one-to-many structure)
    public function products()
    {
        return $this->hasManyThrough(
            Product::class, // Model target
            Transaction::class, // Model perantara
            'order_id', // Foreign key di tabel transactions
            'id', // Foreign key di tabel products
            'id', // Local key di tabel orders
            'product_id' // Local key di tabel transactions
        );
    }

    // Relationship to Transaction (if Transaction is a separate model)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
        // return $this->belongsToMany(Transaction::class)
        // ->withPivot('amount', 'total_price')
        // ->withTimestamps();;
    }
}