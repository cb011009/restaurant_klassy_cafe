<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_number',
        'seating_capacity',
        'status', // Enum column with values 'available' or 'booked'
    ];

    // Define a relationship to reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
   /* use HasFactory;

     protected $fillable = [
        'table_number',
        'seating_capacity',
        'status',
    ];

    /*public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }*/
}
