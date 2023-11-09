<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\UserController;
use App\Models\NewsLetter;
use Illuminate\Notifications\Console\NotificationTableCommand;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//HOME ROUTES
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/send', [EmailController::class, 'sendContactForm'])->name('send.form');

//POSTS ROUTE
Route::get('/blog', [PostsController::class, 'index'])->name('blog.index');
Route::get('/blog/search/', [PostsController::class, 'searchPost'])->name('post.search');
Route::get('/category/posts/{category:slug}', [CategoryController::class, 'indexCategories'])->name('blog.category');
Route::get('/post/{post:permalink}', [PostsController::class, 'show'])->name('post.show');
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/post/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/admin/post/store', [PostsController::class, 'store'])->name('post.store');
    Route::get('/admin/post/index', [PostsController::class, 'indexAdmin'])->name('post.index.admin');
    Route::get('/admin/post/edit/{post:id}', [PostsController::class, 'edit'])->name('post.admin.edit');
    Route::put('/admin/post/update/{post:id}', [PostsController::class, 'update'])->name('post.update');
    Route::delete('/admin/post/delete/{post:id}', [PostsController::class, 'destroy'])->name('post.delete');
});


//USER ROUTES
Route::middleware(['isGuest'])->group(function () {
    Route::get('/login', [UserController::class, 'loginPage'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login.attempt');
    Route::get('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');
});
Route::middleware(['isAuth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/register', [UserController::class, 'registerAdmin'])->name('user.admin.register');
    Route::post('/admin/register', [UserController::class, 'storeAdmin'])->name('user.admin.store');
    Route::get('/admin/users/index', [UserController::class, 'indexAdmin'])->name('admin.users.index');
    Route::get('/admin/users/search', [UserController::class, 'searchUser'])->name('admin.users.index.search');
    Route::delete('/admin/user/delete/{user:id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/admin/user/edit/{user:id}', [UserController::class, 'edit'])->name('user.admin.edit');
    Route::put('/admin/user/update/{user:id}', [UserController::class, 'update'])->name('user.admin.update');
});

//ADMIN ROUTES
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


//COMMENT ROUTES
Route::middleware(['isAuth'])->group(function(){
    Route::get('/admin/comments/index', [CommentController::class, 'indexAdmin'])->name('comment.index.admin');
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/admin/comment/edit/{comment:id}', [CommentController::class, 'edit'])->name('comment.admin.edit');
    Route::put('/admin/comment/update/{comment:id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/admin/comment/delete/{comment:id}', [CommentController::class, 'destroy'])->name('comment.delete');
});
//CATEGORIES ROUTES
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{category:id}', [CategoryController::class, 'edit'])->name('category.admin.edit');
    Route::put('/admin/category/update/{category:id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/categories/{category:id}', [CategoryController::class, 'delete'])->name('category.delete');
});

//NOTIFICATIONS ROUTES

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
    Route::delete('/admin/notification/delete/{notification:id}', [NotificationController::class, 'delete'])->name('notification.delete');
    Route::get('/admin/notification/create', [NotificationController::class, 'create'])->name('notification.create');
    Route::get('/admin/notification/edit/{notification:id}', [NotificationController::class, 'edit'])->name('notification.edit');
    Route::put('/admin/notification/update/{notification:id}', [NotificationController::class, 'update'])->name('notification.update');
    Route::post('/admin/notification/store', [NotificationController::class, 'store'])->name('notification.store');
    Route::get('/admin/notification/seen/{notification:id}', [NotificationController::class, 'seen'])->name('notification.seen');
    Route::get('/admin/notification/unseen/{notification:id}', [NotificationController::class, 'unseen'])->name('notification.unseen');
});

//SLIDES ROUTES
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/slides', [SlideController::class, 'index'])->name('admin.slides');
    Route::delete('/admin/slide/delete/{slide:id}', [SlideController::class, 'delete'])->name('slide.delete');
    Route::get('/admin/slide/create', [SlideController::class, 'create'])->name('slide.create');
    Route::get('/admin/slide/edit/{slide:id}', [SlideController::class, 'edit'])->name('slide.edit');
    Route::put('/admin/slide/update/{slide:id}', [SlideController::class, 'update'])->name('slide.update');
    Route::post('/admin/slide/store', [SlideController::class, 'store'])->name('slide.store');
});

//SUBSCRIBED USERS ROUTES
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/subs', [SubController::class, 'index'])->name('admin.subs');
    Route::delete('/admin/sub/delete/{sub:id}', [SubController::class, 'delete'])->name('sub.delete');
    Route::get('/admin/sub/create', [SubController::class, 'create'])->name('sub.create');
    Route::get('/admin/sub/edit/{sub:id}', [SubController::class, 'edit'])->name('sub.edit');
    Route::put('/admin/sub/update/{sub:id}', [SubController::class, 'update'])->name('sub.update');
    Route::post('/admin/sub/store', [SubController::class, 'store'])->name('sub.store');
    Route::get('/admin/subs/search', [SubController::class, 'searchSub'])->name('subs.search');

});
Route::delete('/sub/delete/', [SubController::class, 'deletePage'])->name('sub.user.delete');
Route::post('/sub/new', [SubController::class, 'new'])->name('sub.new');

//FAQ ROUTES
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/faqs', [FaqController::class, 'index'])->name('admin.faqs');
    Route::delete('/admin/faq/delete/{faq:id}', [FaqController::class, 'delete'])->name('faq.delete');
    Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::get('/admin/faq/edit/{faq:id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/admin/faq/update/{faq:id}', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/admin/faq/store', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/admin/faq/search', [FaqController::class, 'searchSub'])->name('faqs.search');

});

//NEWSLETTERS ROUTES

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/newsletters', [NewsLetterController::class, 'index'])->name('admin.newsletters');
    Route::delete('/admin/newsletter/delete/{newsLetter:id}', [NewsLetterController::class, 'delete'])->name('newsletter.delete');
    Route::get('/admin/newsletter/create', [NewsLetterController::class, 'create'])->name('newsletter.create');
    Route::get('/admin/newsletter/edit/{newsLetter:id}', [NewsLetterController::class, 'edit'])->name('newsletter.edit');
    Route::get('/admin/newsletter/show/{newsLetter:id}', [NewsLetterController::class, 'show'])->name('newsletter.show');
    Route::put('/admin/newsletter/update/{newsLetter:id}', [NewsLetterController::class, 'update'])->name('newsletter.update');
    Route::post('/admin/newsletter/store', [NewsLetterController::class, 'store'])->name('newsletter.store');
    Route::get('/admin/newsletter/search', [NewsLetterController::class, 'searchNewsletter'])->name('newsletter.search');
    Route::get('/admin/newsletter/send/{newsLetter:id}', [NewsLetterController::class, 'sendToSubs'])->name('newsletter.send');

});