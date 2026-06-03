<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Contact;

class AboutController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::getInfo();
        $contact = Contact::getInfo();
        
        return view('about', compact('aboutUs', 'contact'));
    }
}