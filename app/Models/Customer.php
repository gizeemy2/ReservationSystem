<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
      protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'tc_no',
        'gender',
        'passport_no',
        'country',
        'segment',
    ];

    public function reservations(){ return $this->hasMany(Reservation::class); }

    
}
