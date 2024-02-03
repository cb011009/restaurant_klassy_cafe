<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;




class ReservationController extends Controller
{
    public function reservation()
    {
        
        
        $userReservations = Reservation::where('user_id', Auth::id())
        ->where('dining_status', 'not_done')
        ->where('dining_status', '!=', 'cancelled')
        ->get();

    
         return view('reservation', compact('userReservations'));
    


        
    }

    public function storeReservation(Request $request)
{
   
    $request->validate([
            'number_of_guests' => 'required|integer',
            'date' => 'required',
            'time_slot' => 'required',
            'occasion' => 'nullable|string',
            'additional_info' => 'nullable|string',
    ]);

  
    $date = $request->input('date');
    $timeSlot = $request->input('time_slot');

  
    $availableTableCount = Table::where('status', 'free')
        ->whereDoesntHave('reservations', function ($query) use ($date, $timeSlot) {
            $query->where('date', $date)->where('time_slot', $timeSlot);
        })
        ->count();

    if ($availableTableCount === 0) {
     
        return redirect()->route('reservation')
            ->with('error', 'Sorry, all tables are booked for this time slot on ' . $date . '. Please choose a different time or date.');
    }

   
    $table = Table::where('status', 'free')
        ->whereDoesntHave('reservations', function ($query) use ($date, $timeSlot) {
            $query->where('date', $date)->where('time_slot', $timeSlot);
        })
        ->first();

   
    if ($table) {
       
        $table->status = 'booked';
        
        try {
            $table->save();;
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }

       

        $reservation = new Reservation([
            'user_id' => Auth::user()->id,
            'number_of_guests' => $request->input('number_of_guests'),
            'date' => $date,
            'time_slot' => $timeSlot,
            'occasion' => $request->input('occasion'),
            'additional_info' => $request->input('additional_info'),
        ]);

        $reservation->table()->associate($table);
      
        
        try {
            $reservation->save();
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
       
        $userReservations = Reservation::with('table')->where('user_id', Auth::user()->id)->get();
        return view('reservation', compact('userReservations'));

       


    } else {
      
        return redirect()->route('reservation')
            ->with('error', 'Sorry, all tables are booked for this time slot on ' . $date . '. Please choose a different time or date.');
    }


}


public function cancelReservation($id)
{
    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('reservations')->with('error', 'Reservation not found.');
    }

    // Check if the reservation is in the 'not_done' state
    if ($reservation->dining_status !== 'not_done') {
        return redirect()->route('reservation')->with('error', 'Reservation cannot be cancelled.');
    }

    // Get the associated table
    $table = $reservation->table;

    // Update the dining_status to 'cancelled'
    $reservation->dining_status = 'cancelled';

    // Save the changes to the database
    $reservation->save();

    // Update the associated table's status to 'free'
    if ($table) {
        $table->status = 'free';
        $table->save();
    }

    return redirect()->route('reservation')->with('success', 'Reservation has been cancelled.');
}









 


}


