<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'guest_count',
        'segment',
        'passport_no',
        'country',
        'identity_number',
        
        'hotel_name',
        'check_in',
        'check_out',
        'night_count',
        'room_type',
        'hotel_price',
        'hotel_supplier',
        'hotel_note',
    
        'flight_departure',
        'flight_return',
        'airline',
        'pnr',
        'baggage',
        'flight_price',
        'flight_supplier',
    
        'transfer_date',
        'transfer_direction',
        'transfer_price',
        'transfer_supplier',
    
        'insurance_type',
        'insurance_price',
        'insurance_supplier',
    
        'esim_package',
        'esim_price',
        'esim_supplier',
        'payment_type',
        'payment_status',

        'service_fee_usd',
        'total_usd',
        'usd_to_try_rate',
    
        'status',
        'start_date',
        'end_date',
        'note'
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
