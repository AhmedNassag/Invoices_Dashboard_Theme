<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');

//category
Route::get('category/{name_ar?}/{name_en?}/{photo?}', [CategoryController::class, 'index'])->name('category.index');
Route::get('categoryShow/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::post('category', [CategoryController::class, 'store'])->name('category.store');
Route::patch('category', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('categoryDeleteSelected', [CategoryController::class, 'deleteSelected'])->name('category.deleteSelected');
Route::post('categoryForceDelete', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');
Route::post('categoryRestore', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('categoryArchived', [CategoryController::class, 'archived'])->name('category.archived');
Route::get('categoryShowNotification/{id}', [CategoryController::class, 'showNotification'])->name('category.showNotification');



//user & roles
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::post('rolesDelete', [RoleController::class, 'delete'])->name('roles.delete');

    Route::resource('users', UserController::class);
    Route::get('usersShowNotification/{id}', [UserController::class, 'showNotification'])->name('users.showNotification');   
});



//general routes
Route::get('show_file/{folder_name}/{photo_name}', [GeneralController::class, 'show_file'])->name('show_file');
Route::get('download_file/{folder_name}/{photo_name}', [GeneralController::class, 'download_file'])->name('download_file');
Route::get('allNotifications', [GeneralController::class, 'allNotifications'])->name('allNotifications');
Route::get('markAllAsRead', [GeneralController::class, 'markAllAsRead'])->name('markAllAsRead');
Route::get('/{page}', [GeneralController::class, 'index']);

