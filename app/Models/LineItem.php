<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }    
     
    
}
