<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Table;

class ReservationController extends Controller
{
    public function reservation()
    {
        return view('reservation');
    }

    public function __construct()
    {
        $this->middleware('auth'); // Apply the 'auth' middleware to this controller
    }

    public function storeReservation(Request $request)
    {
        // Validate the form data (add validation rules as needed)
        $request->validate([
            /*'user_id',
            'number_of_guests',
            'date',
            'time',
            'occasion',
            'additional_info',*/
            'number_of_guests' => 'required|integer',
            'date' => 'required',
            'time_slot' => 'required',
            'occasion' => 'nullable|string',
            'additional_info' => 'nullable|string',
        ]);

       

        
            
            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->id; 
            $reservation->number_of_guests = $request->input('number_of_guests');
            $reservation->date = $request->input('date');
            $reservation->time_slot = $request->input('time_slot');
            $reservation->occasion = $request->input('occasion');
            $reservation->additional_info = $request->input('additional_info');

            try {
                $reservation->save();
            } catch (\Exception $e) {
                dd($e->getMessage()); // Log the exception message for debugging
            }

          
    }
}
