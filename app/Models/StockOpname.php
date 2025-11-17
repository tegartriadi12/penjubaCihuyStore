<?php

namespace App\Models;

use App\Models\User;
use App\Models\StockOpnameItem;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $fillable = ['user_id','note'];

    public function items()
    {
        return $this->hasMany(StockOpnameItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
