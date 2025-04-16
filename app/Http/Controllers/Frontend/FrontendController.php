<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute_values;
use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Inventory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Banner;
use App\Models\Label;
use App\Models\Video;
use App\Models\PrimaryCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactUsMail;
use App\Models\WhatsappConversation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Counter;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.index');
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    public function collections()
    {
        return view('frontend.pages.collections');
    }

    public function products()
    {
        return view('frontend.pages.products');
    }

   
    
}
