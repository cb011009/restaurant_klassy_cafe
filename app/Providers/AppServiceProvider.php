<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('adult', function ($attribute, $value, $parameters, $validator) {
            
            $dateOfBirth = \Carbon\Carbon::parse($value);
            $age = $dateOfBirth->age;
    
            
            return $age >= 18;
        });
    
      
        Validator::replacer('adult', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'You must be at least 18 years old');
        });
    }
}
