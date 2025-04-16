<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Course;

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
         $courses = Course::where('status',1)->get();
         return view('website.courses',compact('courses'));
    } 
    public function events()
    {
         return view('website.events');
    }


     public function courseDetail()
    {
         return view('website.course_detail');
    }
}
