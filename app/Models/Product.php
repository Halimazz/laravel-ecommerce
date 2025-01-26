<?php

namespace App\Models;
use illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Product extends Model
{
    // use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'stock',
    ];


    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
