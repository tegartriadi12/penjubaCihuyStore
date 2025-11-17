<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use App\Models\ReturnItem;
use App\Models\PurchaseItem;
use App\Models\StockMutation;
use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'unit_id',
        'name',
        'purchase_price',
        'selling_price',
        'barcode',
        'min_stock',
        'description',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }
    public function stockMutations()
    {
        return $this->hasMany(StockMutation::class);
    }
}
