<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\User;
use Hash;
use DB;
use DataTables, Form;

class UserController extends Controller
{
    function __construct() {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<div class='flex items-center justify-center gap-2'>";
                    // $btn .= "<div class='relative group'>
                    //             <a href='" . route('admin.users.show', $row->id) . "' class='view action-success'><i
                    //                 class='fa-solid text-gray-500 group-hover:text-emerald-600 fa-eye transition-all'></i></a>
                    //             <span class='tooltip-top-center group-hover:!block'>View Row</span>
                    //         </div>";
                    $btn .= "<div class='relative group'>
                                <a href='" . route('admin.users.edit', $row->id) . "' class='edit action-info'><i
                                    class='fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all'></i></a>
                                <span class='tooltip-top-center group-hover:!block'>Edit Row</span>
                            </div>";

                    if ($row->is_admin != 1) {
                        $btn .= "<div class='relative group'>
                                <a href='" . route('admin.users.destroy', $row->id) . "' class='delete action-danger'><i
                                class='fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all'></i></a>
                                <span class='tooltip-top-center group-hover:!block'>Delete Row</span>
                                </div>";
                        $btn .= "</div>";
                    }

                    // $btn .= htmlBtn('admin.users.show', $row->id, 'warning', 'eye');
                    // $btn .= htmlBtn('admin.users.edit', $row->id);
                    // $btn .= htmDeleteBtn('admin.users.destroy', $row->id);

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Users',
            'title' => 'Users',
            'slug' => ''
        );
        return view('admin.users.index', compact('data'));
    }



    public function create()
    {

        $roles = Permission::pluck('name', 'id')->all();
        $data['page_management'] = array(
            'page_title' => 'Create User',
            'title' => 'Create User',
            'slug' => 'Show',
        );
        $user = [];

        // dd($roles);
        return view('admin.users.create', compact('user', 'roles', 'data'));
    }



    public function show($id)
    {

        $user = User::find($id);
        $roles = Permission::pluck('name', 'id')->all();
        $data['page_management'] = array(
            'page_title' => 'Show User',
            'title' => 'Show User',
            'slug' => 'Show',
        );

        // dd($roles);
        return view('admin.users.show', compact('user', 'roles', 'data'));
    }



    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        User::create($input);

        $user = User::where('email', $input['email'])->first();
        foreach ($input['permission_id'] as $value) {
            PermissionUser::insert([
                'permission_id' => $value,
                'user_id' => $user->id,
            ]);
        }

        // dd($request->all()); 
        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
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
        $roles = Permission::pluck('name', 'id')->all();

        $data['page_management'] = array(
            'page_title' => 'User',
            'slug' => 'Administration',
            'title' => 'Edit User',
            'add' => 'Edit Unit',
        );
        return view('admin.users.create', compact('user', 'roles', 'data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'permission_id' => 'array',
        ]);
        // dd($request->all());
        $user = User::find($id);

        if (!$user) {
            // Handle the case where the user is not found
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->permission_id = $request->input('permission_id');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        PermissionUser::where('user_id', $user->id)->delete();
        foreach ($user->permission_id as $value) {
            PermissionUser::insert([
                'permission_id' => $value,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        // return redirect()->route('admin.users.index')
        //     ->with('success', 'User deleted successfully');
        return response()->json(['success' => true]);
    }
}
