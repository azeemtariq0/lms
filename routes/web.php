<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LookupController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnrollmentUserController;

// Regular user routes

// Admin Login Route
Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'adminLogin']);

// // Regular User Login Route
Route::get('login', [LoginController::class, 'showUserLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'userLogin']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index']);

// Admin routes (protected with middleware)
// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
//     Route::get('dashboard', function () {
//         return view('admin.dashboard');
//     })->middleware('admin');
// });

// User routes (protected with middleware)
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('website.home');
    });
    Route::get('user-profile', [HomeController::class, 'userProfile']);
});

    Route::get('about-us', [HomeController::class, 'aboutUs']);
    Route::get('contact-us', [HomeController::class, 'contactUs']);
    Route::get('courses', [HomeController::class, 'courses']);
    Route::get('courses/{id}', [HomeController::class, 'courseDetail']);
    Route::get('events', [HomeController::class, 'events']);
    Route::get('signup', [HomeController::class, 'signup']);


// Admin routes (protected with middleware)
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     // Define the admin dashboard route here

//     // Route::get('/', [AdminController::class, 'index'])->name('dashboard');

//     Route::get('dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');  // Define the route name as 'admin.dashboard'
// });


// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Resource

// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {

//     Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//      Route::resource('users', UserController::class);
//      Route::resource('enrollment-users', EnrollmentUserController::class);
//      Route::resource('permissions', PermissionController::class);
//      Route::resource('notifications', NotificationController::class);
//      Route::resource('banners', BannerController::class);
//      Route::resource('categories', CategoryController::class);
//      Route::resource('courses', CourseController::class);

//      // Route::delete('banners/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');

//      //

//      Route::post('/banners/change-status', [BannerController::class, 'changeStatus'])->name('admin.banners.changeStatus');
//      Route::post('/categories/change-status', [CategoryController::class, 'changeStatus'])->name('admin.categories.changeStatus');


//      // Api 
//       // Route::post('/categories/change-status', [CategoryController::class, 'changeStatus'])->name('admin.categories.changeStatus');
     



//      Route::post('change-permission', [LookupController::class,'changePermission']);
// });




Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('categories/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::post('categories/change-status', [CategoryController::class, 'changeStatus'])
        ->name('categories.changeStatus');


   Route::post('courses/change-status', [CourseController::class, 'changeStatus'])
        ->name('courses.changeStatus');

   Route::post('notifications/change-status', [NotificationController::class, 'changeStatus'])
        ->name('notifications.changeStatus');

    // Resource
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);


    Route::post('change-permission', [LookupController::class, 'changePermission']);
    // dashboard charts
    Route::get('/user-chart', function () {
        $sales = User::where('is_admin', 0)->selectRaw('MONTH(created_at) as month,COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')->get();

        return response()->json($sales);
    });
});
