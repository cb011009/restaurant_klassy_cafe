<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;


class AnalyticsController extends Controller
{
   


public function showAnalytics()
{

    /*$mostOrderedProducts = Order::select('product_code', \DB::raw('COUNT(*) as order_count'))
        ->groupBy('product_code')
        ->orderByRaw('order_count DESC')
        ->limit(5)
        ->get();*/

    // Query to find the most ordered products with counts
    /*$mostOrderedProducts = Order::select('products.code', 'products.product_category_id', \DB::raw('COUNT(*) as order_count'))
        ->join('products', 'orders.product_code', '=', 'products.code')
        ->groupBy('products.code', 'products.product_category_id')
        ->orderByRaw('order_count DESC')
        ->limit(5)
        ->get();*/

        $mostOrderedProducts = Order::select(
            'products.code',
            'products.name as product_name',
            'products.product_category_id',
            \DB::raw('COUNT(*) as order_count')
        )
        ->join('products', 'orders.product_code', '=', 'products.code')
        ->groupBy('products.code', 'products.product_category_id', 'products.name')
        ->orderByRaw('order_count DESC')
        ->limit(5)
        ->get();

    // Query to find all products
    $allProducts = Product::all();

    

   

    /*// Query to find the time slots with the most reservations
    $mostReservedTimeSlots = Reservation::select('time_slot')
        ->groupBy('time_slot')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(5)
        ->get();*/

        // Query to find the time slots with the most reservations and their counts
$mostReservedTimeSlots = Reservation::select('time_slot', \DB::raw('COUNT(*) as reservation_count'))
->groupBy('time_slot')
->orderByRaw('reservation_count DESC')
->limit(5)
->get();


    // Query to find unordered products
    $unorderedProducts = Product::whereNotIn('code', $mostOrderedProducts->pluck('product_code')->toArray())
        ->get();

    return view('admin_analytics', compact('mostOrderedProducts', 'allProducts', 'mostReservedTimeSlots', 'unorderedProducts'));

   
}

 
}



