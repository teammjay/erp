<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'compare_price',
        //'category_id',
        //'sub_category_id',
        'brand_id',
        'is_featured',
        'sku',
        'barcode',
        'track_qty',
        'quantity',
        'status',
    ];

    /**
     * Get the category that owns the product.
     */

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }

}
