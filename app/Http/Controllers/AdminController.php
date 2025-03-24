<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class AdminController extends Controller
{
    function __construct()
    {
          
    }
    public function dashboard()
    {
        $data['page_management'] = array(
            'page_title' => 'Dashboard',
            'title' => 'Dashboard',
            'slug' => 'Home'
        );
        return view('admin.dashboard', compact('data'));
    }
}
