<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductType;
use App\Models\ProductCategory;

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
