<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Banner;
use DB;
use DataTables, Form;

class CategoryController extends Controller
{
    function __construct()
    {
     
    }
    public function index(Request $request)
    {
      if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
                    $btn .= htmlBtn('admin.categories.show',$row->id,'warning','eye');
                    $btn .= htmlBtn('admin.categories.edit',$row->id);
                    $btn .= htmDeleteBtn('admin.categories.destroy',$row->id);

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
            'page_title' => 'Categories',
            'slug' => 'Admin'
        );
        return view('admin.categories.index', compact('data'));
    }
    public function create()
    {
        
        $data['page_management'] = array(
                'page_title' => 'Add Categories',
                'title'=>'Add Categories',
                'slug'=>'Add',
            );
        return view('admin.categories.create',compact('data'));
    }

    public function changeStatus(Request $request)
    {
        $banner = Category::find($request->id);

        if ($banner) {
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


   public function store(Request $request )
    {
           $this->validate($request, [
            'name' => 'required',
        ]);
        
        $input = $request->all();
        $user = Category::create($input);
        
        return redirect()->route('admin.categories.index')
        ->with('success','Category created successfully');
    }
     public function show($id)
    {
        $category = Category::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Categories',
                'slug'=>'View',
            );

        return view('admin.categories.create',compact('category' ,'data'));
    }

     public function edit($id)
    {
   
        $category = Category::find($id);
       
         $data['page_management'] = array(
            'page_title' => 'Categories',
            'slug' => 'Edit',
            'title' => 'Edit Categories',
            'add' => 'Edit Categories',
        );
        
        return view('admin.categories.create',compact('category','data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $input = $request->all();
        
        $user = Category::find($id);
        $input['name'] = trim($input['name']);
        $user->update($input);

        
        return redirect()->route('admin.categories.index')
        ->with('success','Category updated successfully');


        
    }

}