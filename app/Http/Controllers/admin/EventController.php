<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Event;
use App\Models\Course;
use App\Models\User;
use DB;
use DataTables, Form;


class EventController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Event::join('batches as b','b.id','=','batch_id')->join('courses as c','c.id','=','events.course_id')->select('events.*','c.course_name','b.batch_title');
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
                                    <a href="' . route('admin.events.edit', $row->id) . '" class="edit action-info">
                                        <i class="fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Edit Row</span>
                                </div>
                                <div class="relative group">
                                    <a href="' . route('admin.events.destroy', $row->id) . '" class="delete action-danger">
                                        <i class="fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Delete Row</span>
                                </div>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Events',
             'title'=>' Events',
            'slug' => 'Admin'
        );
        return view('admin.events.index', compact('data'));
    }
    public function create()
    {

        $batches = Batches::where('status','=',1)->get();
        $courses = Course::where('status','=',1)->get();
        $data['page_management'] = array(
                'page_title' => 'Add Event',
                'title'=>'Add Event',
                'slug'=>'Add',
            );
        return view('admin.events.create',compact('data','courses','batches'));
    }




    public function store(Request $request )
    {
           $this->validate($request, [
            // 'course_name' => 'required',
        ]);
        
        $input = $request->all();

        if(!empty($input['start_date'])){
            $input['start_date'] = date('Y-m-d',strtotime($input['start_date']));
        }

        if(!empty($input['end_date'])){
            $input['end_date'] = date('Y-m-d',strtotime($input['end_date']));
        }


        // dd($input);
        Event::create($input);
        
        return redirect()->route('admin.events.index')
        ->with('success','Event Created Successfully');
    }
     public function show($id)
    {
        $events = Batches::find($id);
        $course = Course::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Batches',
                'slug'=>'View',
            );

        return view('admin.events.create',compact('course','events' ,'data'));
    }

     public function edit($id)
    {
        $courses = Course::where('status',1)->get();
        $batches = Batches::where('status',1)->get();
        $event = Event::find($id);




        // dd($events);


        // dd($batches);
         $users = User::all();
         $data['page_management'] = array(
            'page_title' => 'Events',
            'slug' => 'Edit',
            'title' => 'Edit Events',
            'add' => 'Edit Events',
        );
        
        return view('admin.events.create',compact('users','event','courses','batches','data'));
    }



     public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'course_name' => 'required',
        ]);
        
        $input = $request->all();
        $events = Event::find($id);

        


        if(!empty($input['start_date'])){
            $input['start_date'] = date('Y-m-d',strtotime($input['start_date']));
        }

        if(!empty($input['end_date'])){
            $input['end_date'] = date('Y-m-d',strtotime($input['end_date']));
        }



        $events->update($input);

        
        return redirect()->route('admin.events.index')
        ->with('success','Event updated successfully');

    }

    public function changeStatus(Request $request)
    {
        $events = Event::find($request->id);
        if ($events) {
            $events->status = $request->status;
            $events->save();

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
