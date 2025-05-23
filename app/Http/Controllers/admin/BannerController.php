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
    function __construct() {}
    public function index(Request $request)
    {


        if ($request->ajax()) {
              $data = Banner::query()
                    ->select('*');

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function ($row) {
                        $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
                        $style = $row->status == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                        return '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa-solid fa-pencil"></i> ' . $statusLabel . '</button>';
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="flex items-center justify-center gap-2">
                                    <div class="relative group">
                                        <a href="' . route('admin.banners.edit', $row->id) . '" class="edit action-info">
                                            <i class="fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all"></i>
                                        </a>
                                        <span class="tooltip-top-center group-hover:!block">Edit Row</span>
                                    </div>
                                    <div class="relative group">
                                        <a href="' . route('admin.banners.destroy', $row->id) . '" class="delete action-danger">
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
            'page_title' => 'Banners',
            'title' => 'Banners',
            'slug' => 'Admin'
        );
        return view('admin.banners.index', compact('data'));
    }

    public function create()
    {
        $roles = Permission::pluck('name','id')->all();
        $data['page_management'] = array(
                'page_title' => 'Add Banner',
                'title'=>'Create Banner',
                'slug'=>'Add',
            );
        return view('admin.banners.create',compact('data'));
    }

   public function store(Request $request )
    {
           $this->validate($request, [
            'name' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $input = $request->all();

         if ($request->hasFile('file')) {
        // Get the file from the request
        $image = $request->file('file');

        // Generate a unique name for the image
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move the image to the 'public/uploads' directory
        $image->move(public_path('uploads/banners'), $imageName);

            // Add the image path to the input data
            $input['image'] = $imageName;
            $input['path'] = 'uploads/banners/' . $imageName;
        }

        // dd($input);
        $user = Banner::create($input);
        
        return redirect()->route('admin.banners.index')
        ->with('success','Banner created successfully');
    }
     public function show($id)
    {
        $banner = Banner::find($id);
        $data['page_management'] = array(
                'page_title' => 'Show Banner',
                'title'=>'Show Banner',
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $input = $request->all();
        
        $banner = Banner::find($id);
        $input['name'] = trim($input['name']);


         // Handle the file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $image = $request->file('file');

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the 'public/uploads' directory
            $image->move(public_path('uploads/banners'), $imageName);

            // Delete the old image if it exists (optional)
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            // Add the new image path to the input data
            $input['image'] = $imageName;
            $input['path'] = 'uploads/banners/' . $imageName;
        }

    
        $banner->update($input);

        
        return redirect()->route('admin.banners.index')
        ->with('success','Banner updated successfully');
    }

    public function changeStatus(Request $request)
    {
        $banner = Banner::find($request->id);
        if ($banner) {
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}