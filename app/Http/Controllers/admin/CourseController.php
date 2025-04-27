<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseAttachments;
use App\Models\CourseLectures;
use App\Models\User;
use DataTables, Form;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::join('categories as c', 'c.id', '=', 'category_id')
                ->join('users as u', 'u.id', '=', 'mollim_id')
                ->select('courses.*', 'c.name as category_name', 'u.name as mollim');
            return Datatables::of($data)
            ->addIndexColumn()
             ->editColumn('status', function ($row) {
                     $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
                    $style = $row->status == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                    return '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa-solid fa-pencil"></i> ' . $statusLabel . '</button>';
                })
                ->addColumn('action', function ($row) {

                 return '<div class="flex items-center justify-center gap-2">
                                <div class="relative group">
                                    <a href="' . route('admin.courses.edit', $row->id) . '" class="edit action-info">
                                        <i class="fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Edit Row</span>
                                </div>
                                <div class="relative group">
                                    <a href="' . route('admin.courses.destroy', $row->id) . '" class="delete action-danger">
                                        <i class="fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Delete Row</span>
                                </div>
                            </div>';

               return $btn;
           })
            ->rawColumns(['action','status'])
            ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Courses',
            'title' => ' Courses',
            'slug' => 'Admin'
        );
        return view('admin.courses.index', compact('data'));
    }
    public function create()
    {

        $categories = Category::where('status', '=', 1)->get();
        $users = User::all();
        $data['page_management'] = array(
            'page_title' => 'Add Course',
            'title' => 'Add Course',
            'slug' => 'Add',
        );
        return view('admin.courses.create', compact('data', 'categories', 'users'));
    }




    // public function store(Request $request )
    // {
    //        $this->validate($request, [
    //         // 'course_name' => 'required',
    //     ]);

    //     $input = $request->all();


    //     if ($request->hasFile('file')) {
    //         $image = $request->file('file');

    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/courses'), $imageName);

    //         $input['image'] = $imageName;
    //         $input['path'] = 'uploads/courses/' . $imageName;
    //     }

    //     Course::create($input);

    //     return redirect()->route('admin.courses.index')
    //     ->with('success','Course created successfully');
    // }


    public function store(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
        ]);

        // DB::beginTransaction();

        // try {
        $input = $request->except(['lecture_title', 'lecture_description', 'lecture_duration', 'attachments']);

        $input['slug'] = str_replace(' ', '-', strtolower($input['course_name']));
        // Handle course main image
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/courses'), $imageName);

            $input['image'] = $imageName;
            $input['path'] = 'uploads/courses/' . $imageName;
        }

        // Create Course
        $course = Course::create($input);
        // Handle Lectures
        if ($request->filled('lecture_title')) {
            foreach ($request->lecture_title as $index => $title) {
                CourseLectures::create([
                    'course_id'   => $course->id,
                    'title'       => $title,
                    'description' => $request->lecture_description[$index] ?? '',
                    'duration'    => $request->lecture_duration[$index] ?? '',
                ]);
            }
        }

        // Handle Attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $attachmentName = time() . '_' . $attachment->getClientOriginalName();
                $attachment->move(public_path('uploads/courses/attachments'), $attachmentName);

                CourseAttachments::create([
                    'course_id' => $course->id,
                    'path'      => $attachmentName,
                    'type'      => $attachment->getClientMimeType(),
                    'filesize'  => '40',
                ]);
            }
        }

        DB::commit();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully');

        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->route('admin.courses.index')
        //     ->with('success', 'Course created successfully');
        // }
    }


    public function show($id)
    {
        $course = Course::with('lectures', 'attachments')->find($id);
        $data['page_management'] = array(
            'page_title' => 'Show Courses',
            'slug' => 'View',
        );

        return view('admin.courses.create', compact('course', 'data'));
    }

    public function edit($id)
    {
        $categories = Category::where('status', '!=', 0)->get();
        $course = Course::find($id);
        $users = User::all();
        $data['page_management'] = array(
            'page_title' => 'Courses',
            'slug' => 'Edit',
            'title' => 'Edit Course',
            'add' => 'Edit Course',
        );

        return view('admin.courses.create', compact('users', 'course', 'categories', 'data'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_name' => 'required',
        ]);

        // Begin DB transaction to handle the update safely
        // DB::beginTransaction();

        // try {
            // Get the course
            $course = Course::findOrFail($id);

            // Gather input data, except unnecessary fields
            $input = $request->except(['lecture_title', 'lecture_description', 'lecture_duration', 'attachments']);
            $input['slug'] = str_replace(' ', '-', strtolower($input['course_name']));

            // Trim course names
            $input['course_name'] = trim($input['course_name']);
            $input['course_name_ur'] = trim($input['course_name_ur']);

            // Handle course main image
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/courses'), $imageName);

                // Delete old image if exists
                if ($course->image && file_exists(public_path('uploads/courses/' . $course->image))) {
                    unlink(public_path('uploads/courses/' . $course->image));
                }

                $input['image'] = $imageName;
                $input['path'] = 'uploads/courses/' . $imageName;
            }

            // Update the course
            $course->update($input);

            // Handle Lectures
            if ($request->filled('lecture_title')) {
                foreach ($request->lecture_title as $index => $title) {
                    $lectureData = [
                        'course_id'   => $course->id,
                        'title'       => $title,
                        'description' => $request->lecture_description[$index] ?? '',
                        'duration'    => $request->lecture_duration[$index] ?? '',
                    ];

                    // Create or update the lecture for this course
                    CourseLectures::updateOrCreate(
                        ['course_id' => $course->id, 'title' => $title],
                        $lectureData
                    );
                }
            }

            // Handle Attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $attachmentName = time() . '_' . $attachment->getClientOriginalName();
                    $attachment->move(public_path('uploads/courses/attachments'), $attachmentName);

                    CourseAttachments::create([
                        'course_id' => $course->id,
                        'path'      => $attachmentName,
                        'type'      => $attachment->getClientMimeType(),
                        'filesize'  => "40",
                    ]);
                }
            }

            // Commit transaction
            // DB::commit();

            return redirect()->route('admin.courses.index')
                ->with('success', 'Course updated successfully');
        // } catch (\Exception $e) {
        //     // Rollback transaction in case of error
        //     DB::rollback();

        //     return redirect()->route('admin.courses.index')
        //         ->with('error', 'Course update failed. Please try again.');
        // }
    }


    public function changeStatus(Request $request)
    {
        $banner = Course::find($request->id);

        if ($banner) {
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
