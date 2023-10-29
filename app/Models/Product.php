<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\ShoppingCart;

class Product extends Model
{
    use HasFactory;

    public function product_types(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type');
    }

    public function product_categories(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category');
    }

    // Many to Many relationship between Product and ShoppingCart
    public function shopping_carts(): BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class, 'product_cart', 'product_id', 'shopping_cart_id');
    }

    protected $fillable=[
        'name',
        'description',
        'price',
        'category',
        'product_type',
        'quantity',
        'img'
    ];
}
