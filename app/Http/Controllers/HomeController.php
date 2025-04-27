<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
     public function index()
     {
          $banners = Banner::get();

          $courses = Course::with('mollim')->where('status', 1)->limit(3)->get();
          $events = Event::where('status', 1)->limit(3)->get();
          $upcoming_courses = Course::with('mollim')->where('status', '=', 1)->get();
          return view('website.home', compact('banners','events', 'courses', 'upcoming_courses'));
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
          $courses = Course::with('mollim')->where('status', 1)->get();

          return view('website.courses', compact('courses'));
     }

     function courseContent(){


          $perPage = 3;
          $sql_query = "SELECT * FROM courses";
          $page = 1;
          if(!empty($_GET["page"])) {
          $page = $_GET["page"];
          }
          $start = ($page-1)*$perPage;
          if($start < 0) $start = 0;

          // $query = $sql_query . " limit " . $start . "," . $perPage;
          $courses = Course::with('mollim')->where('status', 1)->skip($start)
                    ->take($perPage)
                    ->get();



          if(!isset($_GET["total_record"]) || empty($_GET["total_record"])) {

          $_GET["total_record"] = count($courses);
          }
          $message = '';

 
          if(!empty($courses)) {
          $message .= '<input type="hidden" class="page_number" value="' . $page . '" />';
          $message .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';
          foreach( $courses as $course) {


           $message .='<div
                class="course-card translate-y-[20px]  h-fit group relative  border border-gray-200 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

                <!-- Image with dark overlay -->
                <div class="relative">
                    <img src="'.asset('/uploads/courses/'.$course['image']).'" alt="'.$course['course_name'].'" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 group-hover:bg-black/10 transition duration-300"></div>

                    <!-- Floating Avatar -->
                    <div class="absolute -bottom-6 left-4 z-10">
                     
                    </div>
                </div>

                <!-- Card Content -->
                <div class="pt-8 pb-4 px-4">
                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">'.$course['course_name'].'</h3>
                    <p class="text-sm text-gray-600 mt-1">'.$course->mollim['name'].'</p>

                    <!-- Optional: Tag badges -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span
                            class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">23 lectures</span>
                        <span
                            class="bg-[#1b4552]/10 text-[#1b4552] text-xs font-semibold px-2.5 py-0.5 rounded-full">'.$course['duration'].'</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-xs text-gray-600">'.$course->created_at->diffForHumans().'</p>
                        <!-- Button -->
                        <a href="'.url('course-detail', $course['slug']).'"
                        class="inline-block float-end mb-4 border border-[#1b4552] bg-[#1b4552] text-white  py-2 px-4 text-sm rounded-full">
                        Enroll now
                    </a>
                </div>
                
                </div>
            </div>';











          }
          }
          echo $message;

     }

     public function events()
     {
          return view('website.events');
     }

     public function courseDetail($id, Request $request)
     {
          $data = Course::with('mollim', 'attachments', 'lectures')->where('slug', $id)->first();
          return view('website.course-detail', compact('data'));
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
