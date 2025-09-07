<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }
    
}
