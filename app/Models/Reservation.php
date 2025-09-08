<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'status',
        'start_date',
        'end_date',
        'note',
        'code'
    ];
    
    protected static function booted()
    {
        static::creating(function ($reservation) {
            $reservation->code = strtoupper(uniqid('RSV-'));
        });
    }

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
