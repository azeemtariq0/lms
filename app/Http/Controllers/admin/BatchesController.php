<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use DB;
use DataTables, Form;


class BatchesController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Batches::join('courses as c','c.id','=','course_id')->select('*');
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
                            <a href='" . route('admin.batches.edit', $row->id) . "' class='edit action-info'><i
                                class='fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all'></i></a>
                            <span class='tooltip-top-center group-hover:!block'>Edit Row</span>
                        </div>";

                    $btn .= "<div class='relative group'>
                            <a href='" . route('admin.batches.destroy', $row->id) . "' class='delete action-danger'><i
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
            'page_title' => 'Batches',
             'title'=>' Batches',
            'slug' => 'Admin'
        );
        return view('admin.batches.index', compact('data'));
    }
    public function create()
    {

        $courses = Course::where('status','=',1)->get();
        $users = User::all();
        $data['page_management'] = array(
                'page_title' => 'Add Batches',
                'title'=>'Add Batches',
                'slug'=>'Add',
            );
        return view('admin.batches.create',compact('data','courses','users'));
    }




    public function store(Request $request )
    {
           $this->validate($request, [
            // 'course_name' => 'required',
        ]);
        
        $input = $request->all();

        // dd($input);
        Batches::create($input);
        
        return redirect()->route('admin.batches.index')
        ->with('success','Batches Created Successfully');
    }
     public function show($id)
    {
        $batches = Batches::find($id);
        $course = Course::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Batches',
                'slug'=>'View',
            );

        return view('admin.batches.create',compact('course','batches' ,'data'));
    }

     public function edit($id)
    {
        $courses = Course::where('status',1)->get();
        $batches = Batches::find($id);
         $users = User::all();
         $data['page_management'] = array(
            'page_title' => 'Batches',
            'slug' => 'Edit',
            'title' => 'Edit Batch',
            'add' => 'Edit Batch',
        );
        
        return view('admin.batches.create',compact('users','courses','batches','data'));
    }



     public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_name' => 'required',
        ]);
        
        $input = $request->all();
        
        $batches = Batches::find($id);
        $input['course_name'] = trim($input['course_name']);
        $input['course_name_ur'] = trim($input['course_name_ur']);


        if ($request->hasFile('file')) {
            $image = $request->file('file');

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/batches'), $imageName);

            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }

            $input['image'] = $imageName;
            $input['path'] = 'uploads/batches/' . $imageName;
        }

    
        $batches->update($input);

        
        return redirect()->route('admin.batches.index')
        ->with('success','Course updated successfully');

    }

    public function changeStatus(Request $request)
    {
        $batches = Batches::find($request->id);
        if ($batches) {
            $batches->status = $request->status;
            $batches->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        Batches::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
