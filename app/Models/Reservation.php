<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    use HasFactory;

   

    

    protected $fillable = [
        // Define the fillable fields of the reservations table here
        'user_id',
        'number_of_guests',
        'time_slot',
        'date',
        'occasion',
        'additional_info',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
   
    public function orders()
{
    return $this->hasMany(Order::class, 'reservation_id');
}
   
}
