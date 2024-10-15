<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UploadController;




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
    return view('wellcome');
});

//Route::prefix('admin')->group(function () {
// Route::get('/', [DashBoardController::class, 'index'])->name('user.index');

//});
Route::get('dashboard.index', [DashboardController::class, 'index'])->name
('dashboard.index')->middleware('admin');


Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::resource('user', \App\Http\Controllers\Backend\UserController::class);
});

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('upload', function () {
    return view('upload');
});

Route::post('upload', [UploadController::class, 'upload'])->name('upload');