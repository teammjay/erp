<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankings extends Model
{
    use HasFactory;
    protected $table = "bankings";
    protected $primaryKey = "banking_id";

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

}
