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
   

/*
public function showAnalytics()
{
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

    $categories = ProductCategory::all();

$mostReservedTimeSlots = Reservation::select('time_slot', \DB::raw('COUNT(*) as reservation_count'))
->groupBy('time_slot')
->orderByRaw('reservation_count DESC')
->limit(5)
->get();


    // Query to find unordered products
    $unorderedProducts = Product::whereNotIn('code', $mostOrderedProducts->pluck('product_code')->toArray())
        ->get();

    return view('admin_analytics', compact('mostOrderedProducts', 'allProducts', 'mostReservedTimeSlots', 'unorderedProducts', 'categories'));

   
}*/

public function showAnalytics(Request $request)
{
    $selectedCategory = $request->input('category');

    $mostOrderedProductsQuery = Order::select(
        'products.code',
        'products.name as product_name',
        'products.product_category_id',
        \DB::raw('COUNT(*) as order_count')
    )
        ->join('products', 'orders.product_code', '=', 'products.code')
        ->groupBy('products.code', 'products.product_category_id', 'products.name')
        ->orderByRaw('order_count DESC');

    // Apply category filter if a category is selected
    if ($selectedCategory) {
        $mostOrderedProductsQuery->where('products.product_category_id', $selectedCategory);
    }

    $mostOrderedProducts = $mostOrderedProductsQuery->limit(5)->get();
    $allProducts = Product::all();
    $categories = ProductCategory::all();

    $mostReservedTimeSlots = Reservation::select('time_slot', \DB::raw('COUNT(*) as reservation_count'))
        ->groupBy('time_slot')
        ->orderByRaw('reservation_count DESC')
        ->limit(5)
        ->get();

    //$unorderedProducts = Product::whereNotIn('code', $mostOrderedProducts->pluck('product_code')->toArray())
        //->get();


        

    return view('admin_analytics', compact('mostOrderedProducts', 'allProducts', 'mostReservedTimeSlots', 'categories', 'selectedCategory'));
}


 
}



