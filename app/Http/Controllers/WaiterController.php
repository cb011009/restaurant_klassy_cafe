<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class WaiterController extends Controller
{
    public function waiter_panel()
{
    return view('waiter_panel');
}
}
