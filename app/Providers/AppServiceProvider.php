<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\MenuComposer;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    
    public function boot()
    {        
        View::composer('frontend.layouts.header-menu', MenuComposer::class);
    }

    
}
