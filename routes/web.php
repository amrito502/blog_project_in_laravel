<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';




Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/detail/{id}', [HomeController::class, 'details'])->name('post.details');
// comment
Route::post('/save-comment/{id}', [HomeController::class, 'save_comment'])->name('save.comment');

// admin routes
Route::get('/admin/login', [AdminController::class, 'admin_login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
Route::post('/submit/form', [AdminController::class, 'submit_login'])->name('admin.submit_login_from');
// category
Route::resource('category', CategoryController::class);
Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

// category
Route::resource('post', PostController::class);
Route::get('post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

Route::get('/admin/settings', [SettingController::class, 'admin_settings'])->name('admin.settings');


Route::post('/admin/save/settings', [SettingController::class, 'save_settings'])->name('admin.save_settings');
