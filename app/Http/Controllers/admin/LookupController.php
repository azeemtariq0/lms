<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Permission;
use App\Models\User;
use App\Models\Banner;
use DB;
use DataTables, Form;

class LookupController extends Controller
{
    function __construct() {}
    public function changePermission(Request $request)
    {
        $data = Permission::where('id', $request->permission_id)->first();
        Session::put('permission_id', $data->id);
        Session::put('permission_name', $data->name);
        echo json_encode(true);
    }
}
