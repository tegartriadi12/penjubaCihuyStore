<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ReturnModel;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $fillable = [
        'return_id','product_id','qty','price','subtotal'
    ];

    public function return()
    {
        return $this->belongsTo(ReturnModel::class, 'return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
