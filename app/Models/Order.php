<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'waiter_id',
        'reservation_id',
        'product_code',
        'quantity',
        'allergies',
    ];

    public function waiter()
    {
        return $this->belongsTo(User::class, 'waiter_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
