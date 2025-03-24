<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
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
                    $btn .= "<div class='relative group'>
                                <a href='" . route('admin.users.show', $row->id) . "' class='action-success'><i
                                    class='fa-duotone text-gray-500 group-hover:text-emerald-600 fa-eye transition-all'></i></a>
                                <span class='tooltip-right group-hover:!block'>View Row</span>
                            </div>";
                    $btn .= "<div class='relative group'>
                                <a href='" . route('admin.users.edit', $row->id) . "' class='action-info'><i
                                    class='fa-duotone text-gray-500 group-hover:text-blue-600 fa-pencil transition-all'></i></a>
                                <span class='tooltip-right group-hover:!block'>Edit Row</span>
                            </div>";
                    $btn .= "<div class='relative group'>
                                <a href='" . route('admin.users.destroy', $row->id) . "' class='action-danger'><i
                                    class='fa-duotone text-gray-500 group-hover:text-rose-600 fa-trash transition-all'></i></a>
                                <span class='tooltip-right group-hover:!block'>Delete Row</span>
                            </div>";
                    $btn .= "</div>";

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

        $user = User::create($input);

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        // $input['permission'] = Hash::make($input['password']);
        $user->update($input);


        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }
}
