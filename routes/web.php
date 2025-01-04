<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\LikeAdminController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\CtvController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JobController;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); 
})->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('backend.dashboard.index'); 
    })->name('backend.dashboard.index');
});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/like/{id}', [HomeController::class, 'toggleLike'])->name('like')->middleware('auth');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/guides', [HomeController::class, 'guides'])->name('guides');
Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/job', [HomeController::class, 'job'])->name('job');
Route::get('/post/{id}', [HomeController::class, 'post'])->name('site.post');
Route::get('/guidesdetail/{id}', [HomeController::class, 'guidesdetail'])->name('guidesdetail');
Route::get('/eventdetail/{id}', [HomeController::class, 'eventdetail'])->name('eventdetail');
Route::get('/jobdetail/{id}', [HomeController::class, 'jobdetail'])->name('jobdetail');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/category', [HomeController::class, 'category'])->name('category');
Route::get('/search', [HomeController::class, 'search'])->name('site.search');
Route::post('/toggle-like/{id}', [HomeController::class, 'toggleLike'])->name('toggle-like');

Route::post('/comment/{id}', [CommentController::class, 'store'])->name('post.comment');

Route::get('/statistics', [BlogAdminController::class, 'statistics'])->name('statistics.index');
Route::prefix('admin')->group(function () {
    Route::get('blogs', [BlogAdminController::class, 'home'])->name('blogs.home'); 
    Route::get('blog/create', [BlogAdminController::class, 'create'])->name('blogs.create'); 
    Route::post('blog/store', [BlogAdminController::class, 'store'])->name('blog.store'); 
    Route::get('blog/{id}/edit', [BlogAdminController::class, 'edit'])->name('blogs.edit');
    Route::put('blog/{id}', [BlogAdminController::class, 'update'])->name('blog.update'); 
    Route::delete('blog/{id}', [BlogAdminController::class, 'destroy'])->name('blog.destroy'); 
    Route::post('blog/toggle-approval/{id}', [BlogAdminController::class, 'toggleApproval'])->name('blog.toggleApproval'); 
    Route::get('blog/{id}', [BlogAdminController::class, 'show'])->name('blogs.show'); 
    Route::get('blogs/search', [BlogAdminController::class, 'search'])->name('blogs.search'); 
});


Route::prefix('admin')->group(function () {
    Route::get('/likes', [LikeAdminController::class, 'index'])->name('likes.index');
    Route::get('/likes/create', [LikeAdminController::class, 'create'])->name('likes.create');
    Route::post('/likes/store', [LikeAdminController::class, 'store'])->name('likes.store');
    Route::get('/likes/{id}/edit', [LikeAdminController::class, 'edit'])->name('likes.edit');
    Route::put('/likes/{like}', [LikeAdminController::class, 'update'])->name('likes.update');
    Route::delete('/likes/{id}', [LikeAdminController::class, 'destroy'])->name('likes.destroy');
    Route::post('/like/{blog}', [LikeAdminController::class, 'toggleLike'])->name('likes.ajax');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/users/{id}/profile', [UserController::class, 'profile'])->name('users.profile');
});
Route::prefix('comments')->name('comment.')->group(function () {
    Route::get('/{blog}', [CommentController::class, 'index'])->name('index');
    Route::get('/create/{blog}', [CommentController::class, 'create'])->name('create');
    Route::post('/store/{blog}', [CommentController::class, 'store'])->name('store');
    Route::get('/edit/{blog}/{comment}', [CommentController::class, 'edit'])->name('edit');
    Route::put('/update/{blog}/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('/delete/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    Route::post('/reply/{comment}', [CommentController::class, 'reply'])->name('reply');
});
//Route::middleware('auth')->post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::post('/comment/store', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts/reply', [ContactController::class, 'reply'])->name('contacts.reply');
Route::post('/contacts/edit-response', [ContactController::class, 'editResponse'])->name('contacts.editResponse');


Route::resource('tags', TagController::class);



Route::middleware('auth')->prefix('ctvien')->group(function () {
    Route::get('/', [CtvController::class, 'index'])->name('ctvien.index');
    Route::get('/create', [CtvController::class, 'create'])->name('ctvien.create');
    Route::post('/store', [CtvController::class, 'store'])->name('ctvien.store');
    Route::get('/edit/{blog}', [CtvController::class, 'edit'])->name('ctvien.edit');
    Route::put('/update/{blog}', [CtvController::class, 'update'])->name('ctvien.update');
    Route::delete('/delete/{blog}', [CtvController::class, 'destroy'])->name('ctvien.destroy');
    Route::put('/{id}/approve', [CtvController::class, 'approve'])->name('ctvien.approve');
    Route::put('/{id}/reject', [CtvController::class, 'reject'])->name('ctvien.reject');

});


Route::prefix('admin')->group(function () {
    Route::get('guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('guide/create', [GuideController::class, 'create'])->name('guides.create');
    Route::get('guide/{id}/edit', [GuideController::class, 'edit'])->name('guides.edit');
    Route::put('guide/{id}', [GuideController::class, 'update'])->name('guides.update'); 
    Route::post('guide/store', [GuideController::class, 'store'])->name('guides.store');
    Route::delete('/guide/{id}', [GuideController::class, 'destroy'])->name('guides.destroy');
    Route::get('guide/{id}', [GuideController::class, 'show'])->name('guides.show'); 
});

Route::prefix('admin')->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('event/create', [EventController::class, 'create'])->name('events.create');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('event/{id}', [EventController::class, 'update'])->name('events.update'); 
    Route::post('event/store', [EventController::class, 'store'])->name('events.store');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('event/{id}', [EventController::class, 'show'])->name('events.show'); 
});

Route::prefix('admin')->group(function () {
    Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('job/create', [JobController::class, 'create'])->name('jobs.create');
    Route::get('job/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('job/{id}', [JobController::class, 'update'])->name('jobs.update'); 
    Route::post('job/store', [JobController::class, 'store'])->name('jobs.store');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('job/{id}', [JobController::class, 'show'])->name('jobs.show'); 
});