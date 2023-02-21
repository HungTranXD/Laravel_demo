<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    //$id không cần vì Model dã có
    protected $fillable = [ //các cột của bảng trừ cột id
        "name",
        "icon",
        "status"
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
