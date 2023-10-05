<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\User; 
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\Order; 
use App\Models\Product; 




class WaiterController extends Controller
{
    public function waiter_panel()
    {
     /* $reservations = []; 
       $currentDate = now()->toDateString();

      return view('waiter_panel', compact('reservations', 'currentDate'));*/
      $reservations = Reservation::all(); // Fetch all reservations

      // Filter reservations to include only "not_done" ones
      $notDoneReservations = $reservations->where('dining_status', 'not_done');
  
      return view('waiter_panel', ['reservations' => $notDoneReservations]);
    }
    
    public function waiter_reservation_list()
    {
      
        $currentDate = now()->toDateString();

        
        $reservations = Reservation::where('date', $currentDate)->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

    /*public function filterReservations(Request $request)
    {
        $currentDate = now()->toDateString();
        $timeSlot = $request->input('time_slot');

       
        $reservations = Reservation::where('date', $currentDate)
            ->where('time_slot', $timeSlot)
            ->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }*/

    public function filterReservations(Request $request)
{
    // Get the selected date and time slot from the form
    $selectedDate = $request->input('date');
    $timeSlot = $request->input('time_slot');

    // Fetch reservations for the selected date and time slot
    $reservations = Reservation::where('date', $selectedDate)
        ->where('time_slot', $timeSlot)
        ->get();

    // Pass the filtered reservations and selected date back to the view
    return view('waiter_panel', compact('reservations', 'selectedDate'));
}

    

    public function markAsDone(Reservation $reservation,$id)
{
    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    // Update the associated table's status to "free"
    if ($reservation->table) {
        $reservation->table->status = 'free';
        $reservation->table->save();
    }

     // Update the dining status of the reservation to "done"
     $reservation->dining_status = 'done';
     $reservation->save();
    

    // Redirect back to the waiter dashboard with a success message
    return redirect()->route('waiter_panel')->with('success', 'Table marked as done.');
}

//newly added 

public function editTable(Request $request, $id)
{
    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    // Fetch all available tables
    $tables = Table::where('status', 'free')->get();

    return view('waiter_edit_table', compact('reservation', 'tables'));
}


public function updateTable(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'table_id' => 'required|integer',
    ]);

    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    // Get the selected table ID from the form
    $tableId = $request->input('table_id');

    // Find the table associated with the previous reservation
    $previousTable = $reservation->table;

    // Update the reservation's table ID
    $reservation->table_id = $tableId;
    $reservation->save();

    // Change the status of the previous table to "free"
    if ($previousTable) {
        $previousTable->status = 'free';
        $previousTable->save();
    }

    //newly added
    // Change the status of the newly assigned table to "booked"
    $newTable = Table::find($tableId);
    if ($newTable) {
        $newTable->status = 'booked';
        $newTable->save();
    }

    // Redirect back to the waiter dashboard with a success message
    return redirect()->route('waiter_panel')->with('success', 'Table updated successfully.');
}






//order
public function createOrder($id)
{
    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    // Fetch all available products or dishes (you'll need a Product model for this)
    $products = Product::all();

    return view('create_order', compact('reservation', 'products'));


    
}


public function storeOrder(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'waiter_id' => 'required|integer',
        'product_codes' => 'required|array',
        'product_codes.*' => 'required|string',
        'quantities' => 'required|array',
        'quantities.*' => 'required|integer',
        'allergies' => 'nullable|array',
        'allergies.*' => 'nullable|string',
    ]);

    // Find the reservation by ID
    $reservation = Reservation::find($id);

    // Check if the reservation exists
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    // Loop through the submitted items and create orders
    $itemsCount = count($request->input('product_codes'));
    for ($i = 0; $i < $itemsCount; $i++) {
        Order::create([
            'waiter_id' => $request->input('waiter_id'),
            'reservation_id' => $id,
            'product_code' => $request->input('product_codes')[$i],
            'quantity' => $request->input('quantities')[$i],
            'allergies' => $request->input('allergies')[$i] ?? null,
        ]);
    }

    // Redirect back to the waiter dashboard with a success message
    return redirect()->route('waiter_panel')->with('success', 'Order created successfully.');
}

/*public function storeOrder(Request $request,$id)
{
    // Validate the form data
    $request->validate([
        'waiter_id' => 'required|integer',
      
        'product_codes' => 'required|string',
        'quantities' => 'required|integer',
        'allergies' => 'nullable|string',
    ]);

    // Create a new order
    /*Order::create([
        'waiter_id' => $request->input('waiter_id'),
      
        'reservation_id' => $id,
        'product_code' => $request->input('product_code'),
        'quantity' => $request->input('quantity'),
        'allergies' => $request->input('allergies'),
    ]);

    $productCodes = $request->input('product_codes');
    $quantities = $request->input('quantities');

    foreach ($productCodes as $key => $productCode) {
        Order::create([
            'waiter_id' => $request->input('waiter_id'),
            'reservation_id' => $id,
            'product_code' => $productCode,
            'quantity' => $quantities[$key],
            'allergies' => isset($allergies[$key]) ? $allergies[$key] : null, // Check if allergies were provided for this item
        ]);
    }

    // Redirect back to the waiter dashboard with a success message
    return redirect()->route('waiter_panel')->with('success', 'Order created successfully.');
}
*/



}
