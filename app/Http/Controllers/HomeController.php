<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('website.home',compact('banners'));
    }
    public function userProfile()
    {
         return view('website.user-profile');
    }
    public function aboutUs()
    {
         return view('website.about-us');
    }
    public function contactUs()
    {
         return view('website.contact-us');
    } 
    public function courses()
    {
         return view('website.courses');
    } public function events()
    {
         return view('website.events');
    }
}
