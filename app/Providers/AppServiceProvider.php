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
           
        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(android|iphone|ipod|mobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $views[] = 'frontend.layouts.mobile-menu';
        }else{
            $views = ['frontend.layouts.header-menu'];
        }
    
        View::composer($views, MenuComposer::class);
    }
    

    
}
