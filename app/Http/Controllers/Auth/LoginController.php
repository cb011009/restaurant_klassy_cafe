<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//added for admin
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = RouteServiceProvider::HOME;*/
   
   

   /*protected function authenticated(Request $request, $user)
   {
       if ($user->user_role === 'admin') {
           return redirect()->route('admin_panel'); // Replace 'admin.dashboard' with your admin panel route name
       } else {
           return redirect()->route('reservation'); // Replace 'user.reservation' with your user route name
       }
   }*/

   protected function authenticated(Request $request, $user)
   {
       if ($user->user_role === 'admin') {
           return redirect()->route('admin_panel'); // Redirect admin to admin dashboard
       } elseif ($user->user_role === 'waiter') {
           return redirect()->route('waiter_panel'); // Redirect waiter to waiter dashboard
       } elseif ($user->user_role === 'chef') {
           return redirect()->route('chef_panel'); // Redirect chef to chef dashboard
       } else {
           return redirect()->route('reservation'); // Redirect customers to reservation page
       }
   }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    

}

