<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;


class AnalyticsController extends Controller
{
    public function showAnalytics()
{
    // Query to find the most ordered products
    $mostOrderedProducts = Order::select('product_code')
        ->groupBy('product_code')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(5)
        ->get();

    // Query to find the time slots with the most reservations
    $mostReservedTimeSlots = Reservation::select('time_slot')
        ->groupBy('time_slot')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(5)
        ->get();

    return view('admin_analytics', compact('mostOrderedProducts', 'mostReservedTimeSlots'));
}

}
