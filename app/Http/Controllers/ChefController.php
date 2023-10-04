<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class ChefController extends Controller
{
    public function chef_panel()
{
    return view('chef_panel');
}
}
