<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        "name",
        "thumbnail",
        "price",
        "quantity",
        "description",
        "status",
        "category_id",
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, "order_products")->withPivot('quantity', 'price');
    }

    public function scopeSearch($query, $search) {
        if($search && $search != "") {
            return $query->where("name", "like", "%$search%");
        }
        return $query;
    }

    public function scopeCategoryFilter($query, $category_id) {
        if($category_id && $category_id != 0) {
            return $query->where("category_id", $category_id);
        }
        return $query;
    }

    public function scopeLowestPrice($query, $lowest_price) {
        if($lowest_price && $lowest_price != "") {
            return $query->where("price", ">=", $lowest_price);
        }
        return $query;
    }

    public function scopeHighestPrice($query, $highest_price) {
        if($highest_price && $highest_price != "") {
            return $query->where("price", "<=", $highest_price);
        }
        return $query;
    }
}
