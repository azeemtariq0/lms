<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\GroupPermission;
use DB;
use DataTables, Form;

class PermissionController extends Controller
{
   function __construct()
   {
     
 }

  public function index(Request $request)
  {
        if ($request->ajax()) {
            $data = Permission::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
                // // if (auth()->user()->haspermissionTo('permission-view') )
                    $btn .= htmlBtn('admin.permissions.show',$row->id,'warning','eye');
                //  // if (auth()->user()->haspermissionTo('permission-edit') )
                    $btn .=htmlBtn('admin.permissions.edit',$row->id);
                 // if (auth()->user()->haspermissionTo('admin.permission-delete') )
                     $btn .= htmDeleteBtn('admin.permissions.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Permissions Management',
            'slug' => ''
        );
        return view('admin.permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $controls = GroupPermission::orderBy('sort_order','asc')->get();
   

        $arrPermissions = [];
        foreach($controls as $value) {

            $module_name = $value->module_name;
            $form_name = $value->form_name;
            $control_access_id = $value->id;
            $route = $value->route;
            $permission_id = $value->permission_id;
            $permission_name = $value->permission_name;
            $arrPermissions[$module_name][$form_name][] = [
                'control_access_id' => $control_access_id,
                'route' => $route,
                'permission_id' => $permission_id,
                'permission_name' => $permission_name,
                'selected' => (isset($permission->permission->$route->$permission_id)? $permission->permission->$route->$permission_id : 0),
            ];
        }

        $arrPermissions['permission'] = $arrPermissions;;
        $permission = (object) $arrPermissions;


        $data['page_management'] = array(
            'page_title' => 'Create New Permissions',
            'slug' => 'Create'
        );
        return view('admin.permissions.create', compact('permission','data'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create([
            'name' => trim($request->input('name')),
            'permission'=> trim(json_encode($request->permission))
        ]);


        
        return redirect()->route('admin.permissions.index')
        ->with('success','Role Create successfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $controls = GroupPermission::orderBy('sort_order','asc')->get();
        $permission = Permission::where('id', $id)->first();
        if(empty($permission)) return $this->jsonResponse([],404," Permission Not Found!");

        $permission->permission = json_decode($permission->permission);

        $arrPermissions = [];
        foreach($controls as $value) {

            $module_name = $value->module_name;
            $form_name = $value->form_name;
            $control_access_id = $value->id;
            $route = $value->route;
            $permission_id = $value->permission_id;
            $permission_name = $value->permission_name;
            $arrPermissions[$module_name][$form_name][] = [
                'control_access_id' => $control_access_id,
                'route' => $route,
                'permission_id' => $permission_id,
                'permission_name' => $permission_name,
                'selected' => (isset($permission->permission[$route][$permission_id])? $permission->permission[$route][$permission_id] : 0),
            ];
        }

        $permission->permission = $arrPermissions;



        

        $data['page_management'] = array(
            'page_title' => 'Show Permissions',
            'slug' => 'Show'
        );

        return view('admin.permissions.show',compact('permission', 'data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $controls = GroupPermission::orderBy('sort_order','asc')->get();
        $permission = Permission::where('id', $id)->first();

        if(empty($permission)) return $this->jsonResponse([],404," Permission Not Found!");

        // dd($permission->permission);

        $permission->permission = !empty($permission->permission) ? @json_decode($permission->permission,true) : null;


        $arrPermissions = [];
         foreach($controls as $value) {

            $module_name = $value->module_name;
            $form_name = $value->form_name;
            $control_access_id = $value->id;
            $route = $value->route;
            $permission_id = $value->permission_id;
            $permission_name = $value->permission_name;
            $arrPermissions[$module_name][$form_name][] = [
                'control_access_id' => $control_access_id,
                'route' => $route,
                'permission_id' => $permission_id,
                'permission_name' => $permission_name,
                'selected' => (isset($permission->permission[$route][$permission_id])? $permission->permission[$route][$permission_id] : 0),
            ];
        }



        $permission->permission = $arrPermissions;

        $data['page_management'] = array(
            'page_title' => 'Edit Permissions',
            'slug' => 'Edit'
        );
        return view('admin.permissions.edit',compact('permission', 'data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->permission = json_encode($request->permission);
        $permission->name = $request->name;
        $permission->updated_at = date('Y-m-d H:i:s');
        $permission->update();
    
        return redirect()->route('admin.permissions.index')
        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
        ->with('success','Permission deleted successfully');
    }
}

