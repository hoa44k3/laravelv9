<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Models\Category;
use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\LikeAdminController;

Route::get('dashboard.index', [DashboardController::class, 'index'])->name
('dashboard.index')->middleware('admin');


Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

// // Route trang đăng ký (GET)
// Route::get('admin/register', [AuthController::class, 'registerForm'])->name('auth.register');


// // Route đăng ký (POST)
// Route::post('admin/register', [AuthController::class, 'register'])->name('auth.register.submit');

// // Route trang đăng nhập (GET)
// Route::get('admin/login', [AuthController::class, 'index'])->name('auth.login');

// // Route đăng nhập (POST)
// Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');

// // Route đăng xuất (POST)
// Route::post('admin/logout', [AuthController::class, 'logout'])->name('auth.logout');




Route::get('/statistics', [BlogAdminController::class, 'statistics'])->name('statistics.index');

Route::prefix('admin')->group(function () {
    Route::get('blogs', [BlogAdminController::class, 'home'])->name('blogs.home'); // Hiển thị danh sách blog
    Route::get('blog/create', [BlogAdminController::class, 'create'])->name('blogs.create'); // Hiển thị form tạo mới blog
    Route::post('blog/store', [BlogAdminController::class, 'store'])->name('blog.store'); // Xử lý lưu blog mới
    Route::get('blog/{id}/edit', [BlogAdminController::class, 'edit'])->name('blogs.edit'); // Hiển thị form chỉnh sửa blog
    Route::put('blog/{id}', [BlogAdminController::class, 'update'])->name('blog.update'); // Xử lý cập nhật blog
    Route::delete('blog/{id}', [BlogAdminController::class, 'destroy'])->name('blog.destroy'); // Xử lý xóa blog
    Route::post('blog/toggle-approval/{id}', [BlogAdminController::class, 'toggleApproval'])->name('blog.toggleApproval'); // Duyệt hay bỏ duyệt blog
    Route::get('blog/{id}', [BlogAdminController::class, 'show'])->name('blogs.show'); // Xem chi tiết blog
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
    Route::get('categories', [CategoryAdminController::class, 'home'])->name('category.home');
 
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
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');



// Route::prefix('comments')->name('comment.')->group(function () {
//     Route::get('/{blog?}', [CommentController::class, 'index'])->name('index');
//     Route::get('/{blog}/create', [CommentController::class, 'create'])->name('create');
//     Route::post('/{blog}/store', [CommentController::class, 'store'])->name('store');
//     Route::get('/{blog}/edit/{comment}', [CommentController::class, 'edit'])->name('edit');
//     Route::put('/{blog}/update/{comment}', [CommentController::class, 'update'])->name('update');
//     Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('destroy');
// });
// Route::prefix('comments')->name('comment.')->group(function () {
//     // Route để hiển thị danh sách bình luận, có thể có hoặc không có bài viết (blog)
//     Route::get('/{blog?}', [CommentController::class, 'index'])->name('index');

//     // Route để tạo bình luận cho một bài viết cụ thể
//     Route::get('/{blog}/create', [CommentController::class, 'create'])->name('create');

//     // Route để lưu bình luận cho một bài viết
//     Route::post('/{blog}/store', [CommentController::class, 'store'])->name('store');

//     // Route để sửa bình luận của một bài viết cụ thể
//     Route::get('/{blog}/edit/{comment}', [CommentController::class, 'edit'])->name('edit');

//     // Route để cập nhật bình luận của một bài viết cụ thể
//     Route::put('/{blog}/update/{comment}', [CommentController::class, 'update'])->name('update');

//     // Route để xóa bình luận
//     Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('destroy');
// });
Route::prefix('comments')->name('comment.')->group(function () {
    Route::get('/{blog?}', [CommentController::class, 'index'])->name('index');
    Route::get('/{blog}/create', [CommentController::class, 'create'])->name('create');
    Route::post('/{blog}/store', [CommentController::class, 'store'])->name('store');
    Route::get('/{blog}/edit/{comment}', [CommentController::class, 'edit'])->name('edit');
    Route::put('/{blog}/update/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('destroy');
});


use App\Http\Controllers\Customer\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/post', [HomeController::class, 'post'])->name('post');
Route::get('/category', [HomeController::class, 'category'])->name('category');

use App\Http\Controllers\ContactController;

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

