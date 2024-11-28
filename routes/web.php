<?php

use App\Http\Controllers\Admin\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// For loading image directly through route
Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('/uploads/{type}/{filename}', function ($type, $filename) {
        $allowed_types = ['users', 'admin'];
        if (in_array($type, $allowed_types)) {
            $path = storage_path('app/uploads/' . $type . '/' . $filename);
            if (!File::exists($path)) {
                // abort(404);
                echo ("Hello");
            }

            $file = File::get($path);
            $type = File::mimeType($path);
            $size = File::size($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            $response->header("Content-Length", $size);
            return $response;
        }
        abort(404);
    })->name('assets.uploads');
});
//End for loading image

/*
|-------------------------Start for  Routes of Admin -------------------------------|
*/
Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/dashbaord', [Admin\AdminDashboardController::class, 'index'])->name('admin.index.dashbaord');
});

/*
|------------------------- End for Routes of Admin -------------------------------|
*/

// Routes BREAK ;

/*
|-------------------------Start for  Routes of User -------------------------------|
*/
Route::middleware(['is_user'])->group(function () {
    Route::get('/user/dashbaord', [User\UserDashboardController::class, 'index'])->name('user.index.dashbaord');

});
/*
|------------------------- End for Routes of User -------------------------------|
*/
