<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'description'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
