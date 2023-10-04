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
      /*return view('waiter_panel');*/
      $reservations = []; // Initialize an empty array or set it to null
       $currentDate = now()->toDateString();

      return view('waiter_panel', compact('reservations', 'currentDate'));
    }
    
    public function waiter_reservation_list()
    {
        // Get the current date
        $currentDate = now()->toDateString();

        // Fetch all reservations for the current date
        $reservations = Reservation::where('date', $currentDate)->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

    public function filterReservations(Request $request)
    {
        $currentDate = now()->toDateString();
        $timeSlot = $request->input('time_slot');

        // Fetch reservations for the current date and selected time slot
        $reservations = Reservation::where('date', $currentDate)
            ->where('time_slot', $timeSlot)
            ->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

}
