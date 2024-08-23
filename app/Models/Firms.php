<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firms extends Model
{
    use HasFactory;
    protected $table = "firms";
    protected $primaryKey = "firm_id";

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}
