<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Order; 
use App\Models\Reservation; 
use Illuminate\Support\Facades\DB;



class ChefController extends Controller
{
    public function chef_panel()
{
    
    /*$orders = Order::all();
    return view('chef_panel', compact('orders'));*/
    

    /*$pendingOrders = DB::table('orders')
            ->where('order_status', 'pending')
            ->get();

        return view('chef_panel', compact('pendingOrders'));*/

        $pendingOrders = Order::with('reservation')
        ->where('order_status', 'pending')
        ->get();

    return view('chef_panel', compact('pendingOrders'));
}

public function markOrderDone($id)
{
    $order = Order::find($id);
    if (!$order) {
        return redirect()->route('chef_panel')->with('error', 'Order not found.');
    }

    // Update the order status to "done"
    $order->update(['order_status' => 'done']);

    return redirect()->route('chef_panel')->with('success', 'Order marked as done.');
}
}
