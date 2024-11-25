<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\LikeAdminController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\ContactController;


// Route đăng xuất
//Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout.submit');

//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Chuyển hướng về trang chính sau khi đăng xuất
})->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');

// Xử lý đăng ký tài khoản
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

Route::get('/login', function () {
    return view('auth.login'); // Giao diện đăng nhập
})->name('login');


// Route cho dashboard admin
Route::middleware('auth')->group(function () {
    // Route dành cho admin
    Route::get('/admin/dashboard', function () {
        return view('backend.dashboard.index'); // Giao diện admin dashboard
    })->name('backend.dashboard.index');
});
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/post/{id}', [HomeController::class, 'post'])->name('site.post');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/category', [HomeController::class, 'category'])->name('category');
Route::post('/like/{id}', [HomeController::class, 'toggleLike'])->name('post.like');

Route::post('/comment/{id}', [CommentController::class, 'store'])->name('post.comment');
// web.php
//Route::post('/like/{id}', [LikeAdminController::class, 'toggleLike'])->name('post.like');


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
    Route::post('/toggle-like/{id}', [LikeAdminController::class, 'toggleLike'])->name('likes.toggleLike');
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
Route::get('/users/{id}', [UserController::class, 'profile'])->name('users.profile');


Route::prefix('comments')->name('comment.')->group(function () {
    // Hiển thị danh sách bình luận, có thể lọc theo blog nếu truyền blog ID
    Route::get('/{blog}', [CommentController::class, 'index'])->name('comment.index');

    // Hiển thị form thêm mới bình luận cho một blog cụ thể
    Route::get('/create/{blog}', [CommentController::class, 'create'])->name('create');

    // Lưu bình luận mới vào cơ sở dữ liệu
    Route::post('/store', [CommentController::class, 'store'])->name('store');

    // Hiển thị form sửa bình luận cho một blog cụ thể
    Route::get('/edit/{blog}/{comment}', [CommentController::class, 'edit'])->name('edit');

    // Cập nhật nội dung bình luận
    Route::put('/update/{blog}/{comment}', [CommentController::class, 'update'])->name('update');

    // Xóa bình luận
    Route::delete('/delete/{comment}', [CommentController::class, 'destroy'])->name('destroy');

    // Hiển thị danh sách bình luận theo categories (nếu cần chức năng này)
    Route::get('/show', [CommentController::class, 'showComments'])->name('show');
    Route::post('/reply/{comment}', [CommentController::class, 'reply'])->name('reply');
});
Route::middleware('auth')->post('/comment/store', [CommentController::class, 'store'])->name('comment.store');





Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');




