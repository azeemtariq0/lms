<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Models\Banner;
use DB;
use DataTables, Form;

class BannerController extends Controller
{
    function __construct()
    {
     
    }
    public function index(Request $request)
    {
      if ($request->ajax()) {
            $data = Banner::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
                    $btn .= htmlBtn('admin.banners.show',$row->id,'warning','eye');
                    $btn .= htmlBtn('admin.banners.edit',$row->id);
                    $btn .= htmDeleteBtn('admin.banners.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Banners',
            'slug' => 'Admin'
        );
        return view('admin.banners.index', compact('data'));
    }
    public function create()
    {
        
        $roles = Permission::pluck('name','id')->all();
        $data['page_management'] = array(
                'page_title' => 'Add Banner',
                'title'=>'Add Banner',
                'slug'=>'Add',
            );
        return view('admin.banners.create',compact('data'));
    }

   public function store(Request $request )
    {
           $this->validate($request, [
            'name' => 'required',
        ]);
        
        $input = $request->all();
        $user = Banner::create($input);
        
        return redirect()->route('admin.banners.index')
        ->with('success','Banner created successfully');
    }
     public function show($id)
    {
        $banner = Banner::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Banner',
                'slug'=>'View',
            );

        return view('admin.banners.create',compact('banner' ,'data'));
    }

     public function edit($id)
    {
   
        $banner = Banner::find($id);
       
         $data['page_management'] = array(
            'page_title' => 'Banner',
            'slug' => 'Edit',
            'title' => 'Edit Banner',
            'add' => 'Edit Banner',
        );
        
        return view('admin.banners.create',compact('banner','data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $input = $request->all();
        
        $user = Banner::find($id);
        $input['name'] = trim($input['name']);
        $user->update($input);

        
        return redirect()->route('admin.banners.index')
        ->with('success','Banner updated successfully');
    }

}