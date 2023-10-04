<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Reservation;
use Carbon\Carbon;


class WaiterController extends Controller
{
    public function waiter_panel()
    {
      $reservations = []; 
       $currentDate = now()->toDateString();

      return view('waiter_panel', compact('reservations', 'currentDate'));
    }
    
    public function waiter_reservation_list()
    {
      
        $currentDate = now()->toDateString();

        
        $reservations = Reservation::where('date', $currentDate)->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

    public function filterReservations(Request $request)
    {
        $currentDate = now()->toDateString();
        $timeSlot = $request->input('time_slot');

       
        $reservations = Reservation::where('date', $currentDate)
            ->where('time_slot', $timeSlot)
            ->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

}
