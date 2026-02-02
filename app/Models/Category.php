<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relationship: A category can have many products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
