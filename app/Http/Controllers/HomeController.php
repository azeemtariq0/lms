<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
     public function index()
     {
          $banners = Banner::get();
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
          $courses = Course::where('status', 1)->get();
          return view('website.courses', compact('courses'));
     }

     public function events()
     {
          return view('website.events');
     }

     public function courseDetail(Request $request)
     {
          return view('website.course-detail');
     }

     public function contactSave(Request $request)
     {
          $validator = Validator::make($request->all(), [
               'name' => 'required|string|max:255',
               'email' => 'required|email|max:255',
               'subject' => 'required|string|max:255',
               'message' => 'required|string',
          ]);

          if ($validator->fails()) {
               return response()->json(['errors' => $validator->errors()], 422);
          }

          Message::create([
               'name' => $request->name,
               'email' => $request->email,
               'subject' => $request->subject,
               'message' => $request->message,
          ]);

          return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
     }
}
