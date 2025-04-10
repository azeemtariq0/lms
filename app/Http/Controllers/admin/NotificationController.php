<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Models\Notification;
use DB;
use DataTables, Form;

class NotificationController extends Controller
{
   function __construct()
   {
     
    }

   public function index(Request $request)
  {
        if ($request->ajax()) {
            $data = Notification::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
              ->editColumn('is_read', function ($row) {
                    $statusLabel = $row->is_read == 1 ? 'Read' : 'Unread';
                    $style = $row->is_read == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                    return '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->is_read . '"><i class="fa-solid fa-pencil"></i> ' . $statusLabel . '</button>';
                })
            ->addColumn('action', function($row){
                 $btn="";
                  
                  return '<div class="flex items-center justify-center gap-2">
                               
                                <div class="relative group">
                                    <a href="' . route('admin.categories.destroy', $row->id) . '" class="delete action-danger">
                                        <i class="fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Delete Row</span>
                                </div>
                            </div>';

               return $btn;
           })
            ->rawColumns(['action','is_read'])
            ->make(true);
        }

        $data['page_management'] = [
            'page_title' => 'Notifications',
            'title' => 'Notifications',
            'slug' => 'Admin'
        ];
        return view('admin.notifications.index', compact('data'));
    }


      public function show($id)
    {
        $user = User::find($id);
        $roles = Permission::pluck('name','id')->all();
        $data['page_management'] = array(
                'page_title' => 'Show User',
                'title'=>'Show',
                'slug'=>'Show',
            );

        // dd($roles);
        return view('admin.users.show',compact('user','roles' ,'data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
        $user = User::find($id);
        $roles = Permission::pluck('name','id')->all();

         $data['page_management'] = array(
            'page_title' => 'User',
            'slug' => 'Administration',
            'title' => 'Edit User',
            'add' => 'Edit Unit',
        );
        
        return view('admin.users.create',compact('user','roles','data'));
    }


     public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);
        
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        
        $user = User::find($id);
        $input['permission'] = Hash::make($input['password']);
        $user->update($input);

        
        return redirect()->route('admin.users.index')
        ->with('success','User updated successfully');
    }


    public function changeStatus(Request $request)
    {
        $notification = Notification::find($request->id);

        if ($notification) {
            $notification->is_read = $request->status;
            $notification->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    

}