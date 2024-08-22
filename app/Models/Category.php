<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'image'
    ];

    public function products()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    

}
