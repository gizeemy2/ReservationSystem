<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
}
