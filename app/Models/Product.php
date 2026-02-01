<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;

   protected $fillable = [
    'name',
    'price',
    'quantity',
    'color',
    'image',
    'category_id'
];



    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
