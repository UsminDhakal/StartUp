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

    //For User

    Route::get('/admin/user/index', [Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::get("/admin/view/user/list", [Admin\UserController::class, "getUser"])->name("admin.user.ajax.list");
    Route::post("/admin/view/user/store", [Admin\UserController::class, "store"])->name("admin.user.store");
    Route::delete("/admin/view/user/delete", [Admin\UserController::class, "delete"])->name("admin.user.delete");


    //For Topic
    Route::get('/admin/topic/index', [Admin\TopicController::class, 'index'])->name('admin.topic.index');
    Route::get("/admin/view/topic/list", [Admin\TopicController::class, "getTopic"])->name("admin.topic.ajax.list");
    Route::post("/admin/view/topic/store", [Admin\TopicController::class, "store"])->name("admin.topic.store");
    Route::delete("/admin/view/topic/delete", [Admin\TopicController::class, "delete"])->name("admin.topic.delete");
    Route::get("/admin/view/topic/status", [Admin\TopicController::class, "status"])->name("admin.topic.status");
    Route::get("/admin/view/total/total/ajax", [Admin\TopicController::class, "getTotalAmount"])->name("admin.topic.total.amount");

    //For Funds
    Route::get('/admin/fund/index', [Admin\FundsController::class, 'index'])->name('admin.fund.index');
    Route::get("/admin/view/fund/list", [Admin\FundsController::class, "getTopic"])->name("admin.fund.ajax.list");
    Route::post("/admin/view/fund/store", [Admin\FundsController::class, "store"])->name("admin.fund.store");
    Route::delete("/admin/view/fund/delete", [Admin\FundsController::class, "delete"])->name("admin.fund.delete");
    Route::get("/admin/view/fund/status", [Admin\FundsController::class, "status"])->name("admin.fund.status");
    Route::get("/admin/view/fund/edit", [Admin\FundsController::class, "edit"])->name("admin.fund.edit");



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


    Route::get('/user/expense', [User\ExpenseController::class, 'index'])->name('user.expense.index');
    Route::get('/user/expense/ajax/get', [User\ExpenseController::class, 'getTopic'])->name('user.expense.ajaxx.get');



});
/*
|------------------------- End for Routes of User -------------------------------|
*/
