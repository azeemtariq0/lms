<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
     {
         $banners = Banner::all();
          return view('website.home', compact('banners'));
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
     }
     public function events()
     {
          return view('website.events');
     }
}
