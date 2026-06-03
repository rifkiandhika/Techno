<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        $featuredProducts = Product::with('variants', 'category')
            ->active()
            ->featured()
            ->limit(8)
            ->get();
        $bestSellers = Product::with('variants', 'category')
            ->active()
            ->bestSeller()
            ->limit(8)
            ->get();
        $testimonials = Testimonial::active()->limit(6)->get();
        $aboutUs = AboutUs::getInfo();
        $contact = Contact::getInfo();

        return view('home', compact('banners', 'featuredProducts', 'bestSellers', 'testimonials', 'aboutUs', 'contact'));
    }
}
