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
      $reservations = Reservation::all(); 

      $notDoneReservations = $reservations->where('dining_status', 'not_done');
  
      return view('waiter_panel', ['reservations' => $notDoneReservations]);
    }
    
    public function waiter_reservation_list()
    {
      
        $currentDate = now()->toDateString();

        $reservations = Reservation::where('date', $currentDate)->get();

        return view('waiter_panel', compact('reservations', 'currentDate'));
    }

    public function filterReservations(Request $request)
    {
        $selectedDate = $request->input('date');
        $timeSlot = $request->input('time_slot');
    
        $reservations = Reservation::where('date', $selectedDate)
            ->where('time_slot', $timeSlot)
            ->get();
    
        $reservations = $reservations->filter(function ($reservation) {
            return $reservation->dining_status === 'not_done';
        });
    
        return view('waiter_panel', compact('reservations', 'selectedDate'));
    }
    

    

    public function markAsDone(Reservation $reservation,$id)
{
    
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

   
    if ($reservation->table) {
        $reservation->table->status = 'free';
        $reservation->table->save();
    }

    
     $reservation->dining_status = 'done';
     $reservation->save();
    

   
    return redirect()->route('waiter_panel')->with('success', 'Table marked as done.');
}



public function editTable(Request $request, $id)
{
   
    $reservation = Reservation::find($id);

    
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

   
    $tables = Table::where('status', 'free')->get();

    return view('waiter_edit_table', compact('reservation', 'tables'));
}


public function updateTable(Request $request, $id)
{
    
    $request->validate([
        'table_id' => 'required|integer',
    ]);

    
    $reservation = Reservation::find($id);

   
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

    
    $tableId = $request->input('table_id');

    
    $previousTable = $reservation->table;

   
    $reservation->table_id = $tableId;
    $reservation->save();

    
    if ($previousTable) {
        $previousTable->status = 'free';
        $previousTable->save();
    }

    
    $newTable = Table::find($tableId);
    if ($newTable) {
        $newTable->status = 'booked';
        $newTable->save();
    }

   
    return redirect()->route('waiter_panel')->with('success', 'Table updated successfully.');
}


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

    
    $reservation = Reservation::find($id);

    
    if (!$reservation) {
        return redirect()->route('waiter_panel')->with('error', 'Reservation not found.');
    }

   
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

    return redirect()->back()->with('success', 'Order created successfully.');

}




public function visitCustomerFoodProfile(Reservation $reservation)
    {
$userReservations = $reservation->user->reservations;

$reservationsGroupedByDay = $userReservations->groupBy([
    function ($item) {
        return Carbon::parse($item->date)->format('l'); 
    },
    'time_slot',
]);

$totalReservationsPerDay = $userReservations->groupBy(function ($item) {
    return Carbon::parse($item->date)->format('l'); // Convert date to day of the week
})->map->count();

$mostFrequentDay = $totalReservationsPerDay->sortDesc()->keys()->first();
$mostFrequentTimeSlot = $userReservations->groupBy('time_slot')->map->count()->sortDesc()->keys()->first();

$allDaysOfWeek = collect([
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
]);

$frequentDays = $totalReservationsPerDay->filter(function ($count) {
    return $count > 3;
});

$userOrders = $userReservations->flatMap(function ($reservation) {
    return $reservation->orders;
});


$mostOrderedDishes = $userOrders->groupBy('product_code');

$productDetails = [];
foreach ($mostOrderedDishes as $productCode => $orders) {
    $product = Product::where('code', $productCode)->first(); 
    if ($product) {
        $allergies = $orders->pluck('allergies')->unique()->filter(); 
        $productDetails[$productCode] = [
            'name' => $product->name,
            'allergies' => $allergies->toArray(),
        ];
    }
}


$mostOrderedDish = $mostOrderedDishes->sortDesc()->keys()->first();


return view('food_profile', [
    'reservation' => $reservation,
    'reservationsGroupedByDay' => $reservationsGroupedByDay,
    'totalReservationsPerDay' => $totalReservationsPerDay,
    'mostFrequentDay' => $mostFrequentDay,
    'mostFrequentTimeSlot' => $mostFrequentTimeSlot,
    'allDaysOfWeek' => $allDaysOfWeek,
    'frequentDays' => $frequentDays,
    'mostOrderedDishes' => $mostOrderedDishes,
    'mostOrderedDish' => $mostOrderedDish,
    'productDetails' => $productDetails,
]);











        
    }



}
