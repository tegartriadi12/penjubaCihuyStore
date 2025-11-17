<?php

namespace App\Models;

use App\Models\ReturnItem;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $fillable = [
        'return_number',
        'transaction_id',
        'user_id'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function items()
    {
        return $this->hasMany(ReturnItem::class, 'return_id');
    }
}
