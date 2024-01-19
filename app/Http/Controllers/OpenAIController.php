<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Table;


class OpenAIController extends Controller
{


    public function index(){
 
        return view('chat', [
            'message' => 'Welcome to the chatbot!'
        ]);
    }
 
    
    /*
    public function getResponse(Request $request)
{
    $apiKey = config('services.openai.secret');


    $prompt = 'Following is a dataset based on a restaurant called Klassy Cafe.

    - Most ordered menu item during 8.30pm to 9.30pm -  Avacado and Salmon Sushi
    - Most ordered menu item during 9.30pm to 10.30pm -  Teryaki chicken 
    - Peak reservation time - 7.00pm to 9.00pm
    - Managers name - Vipula
    
    Based on the information, answer the questions as a waiter.
    
    Q:'. $request->get('message');

    $result = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt
            ],
        ],
    ], ['headers' => ['Authorization' => 'Bearer ' . $apiKey]]);

    return view('chat', [
        'message' => $result->choices[0]->message->content
    ]);
}*/




public function getResponse(Request $request)
{
    $apiKey = config('services.openai.secret');

    // Fetch analytics data
    $mostOrderedProducts = Order::select('product_code')
        ->groupBy('product_code')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(5)
        ->get();

    $mostReservedTimeSlots = Reservation::select('time_slot')
        ->groupBy('time_slot')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(5)
        ->get();

     // Fetch all product categories
     $allCategories = ProductCategory::pluck('category_name')->toArray();

     $additionalQuestions = [
       
        "Can I make a reservation for a large party or special event?",
        "Are there any happy hour or special promotions?",
        "Do you have a kids' menu or options for children?",
        "Can I customize my order or request special preparations?",
        "Is there a corkage fee if I bring my own wine?",
        "Are there any live entertainment or events at the restaurant?",
        "Do you offer gift cards for purchase?",
        "Can I book a table with a specific view or seating preference?",
        "Are there any outdoor seating options?",
    ];
    
   

    // Build prompt dynamically based on analytics data
    $prompt = 'Following is a dataset based on a restaurant called Klassy Cafe.';

    $prompt .= "\n- Types of cuisines served: " . implode(', ', $allCategories);

    // Add most ordered products to the prompt
    $prompt .= "\n- Most ordered menu items:";
    foreach ($mostOrderedProducts as $product) {
        $productDetails = Product::where('code', $product->product_code)->first();
        
        if ($productDetails) {
            $prompt .= " - " . $productDetails->name . ": " . $productDetails->description;
        } else {
            $prompt .= " - Product details not found for code: " . $product->product_code;
        }
    }

    // Fetch and display dishes for each cuisine
    foreach ($allCategories as $category) {
        $categoryDishes = Product::whereHas('category', function ($query) use ($category) {
            $query->where('category_name', $category);
        })->get();

        $prompt .= "\n- {$category} dishes:";
        foreach ($categoryDishes as $dish) {
            $prompt .= "\n  - {$dish->name}: {$dish->description}";
        }
    }

    // Add most reserved time slots to the prompt
    $prompt .= "\n- Most reserved time slots:";
    foreach ($mostReservedTimeSlots as $timeSlot) {
        $prompt .= " - " . $timeSlot->time_slot;
    }

     // Add the additional questions to the prompt
     $prompt .= "\n- Additional questions:";
     foreach ($additionalQuestions as $question) {
         $prompt .= "\n  - " . $question;
     }
    

// Add a response for outdoor seating options
$prompt .= "\n- Outdoor seating options:";
$prompt .= "\n  - Q: Do you have outdoor seating options?";
$prompt .= "\n  - A: No we do not";

$prompt .= "\n- happy hour:";
$prompt .= "\n  - Q: Are there any happy hour or special promotions?";
$prompt .= "\n  - A: Yes, we have happy hour between 7 pm and 8 pm where we offer a 20 percent off on selected dishes.";


     // Add the remaining static information to the prompt
    $prompt .= "\n- Managers name - Vipula";
    $prompt .= "\n\nBased on the information, answer the questions as a waiter assisting a customer who has yet to visit your restaurant.\n\nQ:" . $request->get('message');

    // Make the API call to OpenAI
    $result = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt
            ],
        ],
    ], ['headers' => ['Authorization' => 'Bearer ' . $apiKey]]);

    return view('chat', [
        'message' => $result->choices[0]->message->content
    ]);
}


    

}



