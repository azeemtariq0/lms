<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
 
    public function dashboard()
    {
        $data['page_management'] = array(
            'page_title' => 'Dashboard',
            'slug' => 'Home'
        );
        return view('admin.dashboard', compact('data'));
    }
}
