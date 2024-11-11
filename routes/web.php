<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Models\Category;
use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\LikeAdminController;

Route::get('dashboard.index', [DashboardController::class, 'index'])->name
('dashboard.index')->middleware('admin');


Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');



Route::get('/', [HomeController::class, 'index']);

Route::prefix('backend')->group(function () {
    Route::resource('blogs', BlogController::class)->names([
        'index' => 'backend.blog.index',
        'create' => 'backend.blog.create',
        'store' => 'backend.blog.store',
        'show' => 'backend.blog.show',
        'edit' => 'backend.blog.edit',
        'update' => 'backend.blog.update',
        'destroy' => 'backend.blog.destroy',
    ]);
    Route::post('blogs/{blog}/approve', [BlogController::class, 'approve'])->name('backend.blog.approve');
    Route::get('blogs/{blog}/comments', [CommentController::class, 'index'])->name('backend.comment.index');
});
Route::get('/statistics', [BlogAdminController::class, 'statistics'])->name('statistics.index');

Route::prefix('admin')->group(function () {
    Route::get('blogs', [BlogAdminController::class, 'home'])->name('blogs.home');
    Route::get('blog/create', [BlogAdminController::class, 'create'])->name('blogs.create');
    Route::post('blog/store', [BlogAdminController::class, 'store'])->name('blog.store');
    Route::get('blog/{id}/edit', [BlogAdminController::class, 'edit'])->name('blogs.edit');
    Route::put('blog/{id}', [BlogAdminController::class, 'update'])->name('blog.update');
    Route::delete('blog/{id}', [BlogAdminController::class, 'destroy'])->name('blog.destroy');
    Route::post('/blog/toggle-approval/{id}', [BlogAdminController::class, 'toggleApproval'])->name('blog.toggleApproval');
    
});

Route::prefix('admin')->group(function () {
    Route::get('/likes', [LikeAdminController::class, 'index'])->name('likes.index');
    Route::get('/likes/create', [LikeAdminController::class, 'create'])->name('likes.create');
    Route::post('/likes/store', [LikeAdminController::class, 'store'])->name('likes.store');
    Route::get('/likes/{id}/edit', [LikeAdminController::class, 'edit'])->name('likes.edit');
    Route::put('/likes/{like}', [LikeAdminController::class, 'update'])->name('likes.update');
    Route::delete('/likes/{id}', [LikeAdminController::class, 'destroy'])->name('likes.destroy');
});


Route::prefix('admin')->group(function () {
    Route::get('categorie', [CategoryAdminController::class, 'home'])->name('category.home');
    Route::get('category/create', [CategoryAdminController::class, 'create'])->name('category.create');
    Route::get('category/{id}/edit', [CategoryAdminController::class, 'edit'])->name('category.edit');
    Route::put('category/{id}', [CategoryAdminController::class, 'update'])->name('category.update'); 
    Route::post('category/store', [CategoryAdminController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryAdminController::class, 'destroy'])->name('category.destroy');
});

Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::prefix('comments')->name('comment.')->group(function () {
    Route::get('/{blog?}', [CommentController::class, 'index'])->name('index');
    Route::get('/{blog}/create', [CommentController::class, 'create'])->name('create');
    Route::post('/{blog}/store', [CommentController::class, 'store'])->name('store');
    Route::get('/{blog}/edit/{comment}', [CommentController::class, 'edit'])->name('edit');
    Route::put('/{blog}/update/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('destroy');
});