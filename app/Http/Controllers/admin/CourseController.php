<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use DB;
use DataTables, Form;

class CourseController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Course::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
             ->editColumn('status', function ($row) {
                    $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
                    $style = $row->status == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                    return '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa-solid fa-pencil"></i> ' . $statusLabel . '</button>';
                })
            ->addColumn('action', function($row){
                

                $btn = "<div class='flex items-center justify-center gap-2'>";

                    $btn .= "<div class='relative group'>
                            <a href='" . route('admin.courses.edit', $row->id) . "' class='edit action-info'><i
                                class='fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all'></i></a>
                            <span class='tooltip-top-center group-hover:!block'>Edit Row</span>
                        </div>";

                    $btn .= "<div class='relative group'>
                            <a href='" . route('admin.courses.destroy', $row->id) . "' class='delete action-danger'><i
                            class='fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all'></i></a>
                            <span class='tooltip-top-center group-hover:!block'>Delete Row</span>
                            </div>";
                    $btn .= "</div>";



               return $btn;
           })
             ->addColumn('status', function($row){
                  $btn = '';
        $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
        $statusColor = $row->status == 1 ? 'success' : 'danger';
        
        $btn .= '<button class="btn btn-' . $statusColor . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa fa-pencil" ></i> ' . $statusLabel . '</button>';
        return $btn;
           })
            ->rawColumns(['action','status'])
            ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Courses',
             'title'=>' Courses',
            'slug' => 'Admin'
        );
        return view('admin.courses.index', compact('data'));
    }
    public function create()
    {

        $categories = Category::where('status','=',1)->get();
        $users = User::all();
        $data['page_management'] = array(
                'page_title' => 'Add Course',
                'title'=>'Add Course',
                'slug'=>'Add',
            );
        return view('admin.courses.create',compact('data','categories','users'));
    }




    public function store(Request $request )
    {
           $this->validate($request, [
            // 'course_name' => 'required',
        ]);
        
        $input = $request->all();


          if ($request->hasFile('file')) {
        // Get the file from the request
        $image = $request->file('file');

        // Generate a unique name for the image
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move the image to the 'public/uploads' directory
        $image->move(public_path('uploads/courses'), $imageName);

            // Add the image path to the input data
            $input['image'] = $imageName;
            $input['path'] = 'uploads/courses/' . $imageName;
        }


        // dd($input);
        Course::create($input);
        
        return redirect()->route('admin.courses.index')
        ->with('success','Course created successfully');
    }
     public function show($id)
    {
        $course = Course::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Courses',
                'slug'=>'View',
            );

        return view('admin.courses.create',compact('course' ,'data'));
    }

     public function edit($id)
    {
        $categories = Category::where('parent_id','<=',0)->get();
        $course = Course::find($id);
         $users = User::all();
         $data['page_management'] = array(
            'page_title' => 'Courses',
            'slug' => 'Edit',
            'title' => 'Edit Course',
            'add' => 'Edit Course',
        );
        
        return view('admin.courses.create',compact('users','course','categories','data'));
    }



     public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_name' => 'required',
        ]);
        
        $input = $request->all();
        
        $course = Course::find($id);
        $input['course_name'] = trim($input['course_name']);
        $input['course_name_ur'] = trim($input['course_name_ur']);


          // Handle the file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $image = $request->file('file');

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the 'public/uploads' directory
            $image->move(public_path('uploads/courses'), $imageName);

            // Delete the old image if it exists (optional)
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }

            // Add the new image path to the input data
            $input['image'] = $imageName;
            $input['path'] = 'uploads/courses/' . $imageName;
        }

    
        $course->update($input);

        
        return redirect()->route('admin.courses.index')
        ->with('success','Course updated successfully');

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
