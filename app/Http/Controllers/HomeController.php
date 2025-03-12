<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.home');
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
