<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderItem;

class Product extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity',
        'description',
        'image_path',
    ];

    /**
     * Relationship: Product belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: Product has many OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if product is low in stock
     */
    public function getIsLowStockAttribute()
    {
        return $this->quantity <= 5 && $this->quantity > 0;
    }

    /**
     * Check if product is out of stock
     */
    public function getIsOutOfStockAttribute()
    {
        return $this->quantity == 0;
    }
    // Relationships
   

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }

    
}
