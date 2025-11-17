<?php

namespace App\Models;

use App\Models\User;
use App\Models\ReturnModel;
use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'customer_name',
        'total',
        'paid',
        'change',
        'payment_method',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function returns()
    {
        return $this->hasMany(ReturnModel::class);
    }
}
