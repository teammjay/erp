<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table='sub_categories';
    protected $primaryKey = 'subcat_id';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id',
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function products()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
