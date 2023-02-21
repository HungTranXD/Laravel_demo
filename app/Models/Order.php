<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'grand_total',
        'status',
        'shipping_address',
        'customer_tel',
        'created_at'
    ];

    public function products() {
        //return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
        return $this->belongsToMany(Product::class, "order_products")->withPivot('quantity', 'price');
    }

}
