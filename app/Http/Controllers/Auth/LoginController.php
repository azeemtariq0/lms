<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
  // Show Admin Login Form
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    // Admin Login Logic
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check credentials and if the user is an admin
        if (Auth::attempt($credentials) && Auth::user()->is_admin) {


            $ids = auth()->user()->permission_id;
            $permissions = Permission::whereIn('id',$ids)->first();
              Session::put('user_permissions', $permissions);
              Session::put('permission_id', $permissions->id);
            
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials or not an admin']);
    }

    // Show User Login Form
    public function showUserLoginForm()
    {
        return view('auth.login');
    }

    // User Login Logic
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if the user is a regular user
        if (Auth::attempt($credentials) && !Auth::user()->is_admin) {
            return redirect('/'); // Or any route for regular users
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

 public function logout(Request $request)
{
    // Check if the user is logged in and is an admin
    $isAdmin = Auth::check() && Auth::user()->is_admin;

    // Log out the user
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the session ID to avoid session fixation attacks
    $request->session()->regenerateToken();

    // Redirect based on whether the user is an admin
    if ($isAdmin) {
        // Redirect to the admin login page or any other page for admins
        return redirect('admin/login');
    }

    // Redirect regular users to the home page or login page
    return redirect('login');
}

}
