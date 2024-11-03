<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UploadController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\LikeController;
use App\Models\Category;

use App\Http\Controllers\Backend\ImageUploadController;


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

Route::get('customers', function (){
    return view('backend.customers.index');
});


Route::prefix('backend')->group(function () {
    // Các route resource cho blog
    Route::resource('blogs', BlogController::class)->names([
        'index' => 'backend.blog.index',
        'create' => 'backend.blog.create',
        'store' => 'backend.blog.store',
        'show' => 'backend.blog.show',
        'edit' => 'backend.blog.edit',
        'update' => 'backend.blog.update',
        'destroy' => 'backend.blog.destroy',
    ]);

    // Route để duyệt bài viết
    Route::post('blogs/{blog}/approve', [BlogController::class, 'approve'])->name('backend.blog.approve');

    // Route cho bình luận của từng bài viết
    Route::get('blogs/{blog}/comments', [CommentController::class, 'index'])->name('backend.comment.index');
});
Route::get('backend/statistics', [BlogController::class, 'statistics'])->name('backend.statistics.index');

Route::get('backend/categories', [CategoryController::class, 'index'])->name('backend.category.index');
Route::get('backend/categories/create', [CategoryController::class, 'create'])->name('backend.category.create');  // Show form to create a new category
Route::post('backend/categories', [CategoryController::class, 'store'])->name('backend.category.store');     // Store a new category
Route::get('backend/categories/{category}/edit', [CategoryController::class, 'edit'])->name('backend.category.edit');  // Show form to edit a category
Route::put('backend/categories/{category}', [CategoryController::class, 'update'])->name('backend.category.update');  // Update a category
Route::delete('backend/categories/{category}', [CategoryController::class, 'destroy'])->name('backend.category.destroy');  // Delete a category
Route::get('/backend/category/{id}', [CategoryController::class, 'show'])->name('backend.category.show');

Route::get('/backend/comments', [CommentController::class, 'indexAll'])->name('backend.comment.indexAll');
Route::get('backend/blogs/{blog}/comments', [CommentController::class, 'index'])->name('backend.comment.index');
Route::get('backend/blogs/{blog}/comments/create', [CommentController::class, 'createComment'])->name('backend.comment.create');
Route::post('{blog}/comments', [CommentController::class, 'store'])->name('backend.comment.store');
//Route::get('{blog}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('backend.comment.edit');
Route::put('{blog}/comments/{comment}', [CommentController::class, 'update'])->name('backend.comment.update');
Route::delete('{blog}/comments/{comment}', [CommentController::class, 'destroy'])->name('backend.comment.destroy');
Route::get('backend/comment/edit/{blog}/{comment}', [CommentController::class, 'edit'])->name('backend.comment.edit');

Route::prefix('backend')->group(function () {
    Route::resource('likes', LikeController::class)->names([
        'index' => 'backend.likes.index',
        'create' => 'backend.likes.create',
        'store' => 'backend.likes.store',
        'edit' => 'backend.likes.edit',
        'update' => 'backend.likes.update',
        'destroy' => 'backend.likes.destroy'
    ]);
});

 

// Route trang upload ảnh
Route::get('/Image/upload', [ImageUploadController::class, 'index'])->name('Image.upload.index');

// Route xử lý upload ảnh
Route::post('/Image/upload', [ImageUploadController::class, 'upload'])->name('Image.upload.store');
Route::get('/Image/uploadqr', [ImageUploadController::class, 'showQrCode'])->name('Image.upload.qr');
Route::post('/Image/upload', [ImageUploadController::class, 'upload'])->name('Image.upload.submit');
Route::get('/Image/show-qr-code', [ImageUploadController::class, 'showQrCode'])->name('Image.showQrCode');
Route::get('/Image/download/{filename}', [ImageUploadController::class, 'download'])->name('Image.download');

// Route hiển thị trang upload home
Route::get('/Image/uploadhome', [ImageUploadController::class, 'showUploadHome'])->name('Image.uploadhome');

// Route xử lý upload file qua kéo thả
Route::post('/Image/upload-drag-drop', [ImageUploadController::class, 'uploadDragDrop'])->name('Image.upload.dragdrop');


