<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermissions;
use App\Http\Controllers\ProfileController;
use Illuminate\Contracts\Auth\UserProvider;
use App\Http\Controllers\website\BlogsController;
use App\Http\Controllers\website\EmailController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\website\CommentController;
use App\Http\Controllers\website\ProductsController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\WebsiteController;
use App\Http\Controllers\Dashboard\CategoryController;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\ActivityLogController;
use App\Http\Controllers\website\StripePaymentController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('website.index');
})->middleware('track');

Route::get('/about-us', function () {
    return view('website.about-us');
});
Route::get('/contact', function () {
    return view('website.contact');
});
Route::get('/report', [DashboardController::class, 'reports'])
->name('view.report');
Route::get('/faq', function () {
    return view('website.faq');
});
Route::get('/404', function () {
    return view('website.404');
});
Route::get('/login', function () {
    return view('website.login');
});
Route::get('/cart', function () {
    return view('website.cart');
});
Route::get('/checkout', function () {
    return view('website.checkout');
});
Route::get('/wishlist', function () {
    return view('website.wishlist');
});
Route::get('/article', function () {
    return view('website.article');
});

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('ShowStripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('/blogs/{slug}',[BlogsController::class,'Blogshow'])->name('blog-show');
Route::get('/blogs',[BlogsController::class,'index']);

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('profile/{id}', 'showUserProfile')->name('user-profile');
    Route::post('updateProfile/{id}',  'updateUserProfile')->name('updateUserProfile');

});

Route::post('/place-order',[ProductsController::class,'Order'])->name('place.order');
Route::post('/send-email',[EmailController::class,'sendEmail'])->name('send.Email');



Route::get('/product/{slug}',[ProductsController::class,'showProduct'])->name('product.website');
Route::get('/get-product-quantity',[ProductsController::class,'getQuantity'])->name('getQuantity');
Route::get('/get-product-quantity-color',[ProductsController::class,'getQuantityColor'])->name('getQuantityColor');
Route::get('/shop',[ProductsController::class,'index'])->name('products.index');
Route::post('validatePromoCode',[ProductController::class,'validatePromoCode'])->name('validatePromoCode');

Route::controller(PermissionController::class)->prefix('permissions')->group(function () {
    Route::get('', 'showPermissions')->name('assign-permissions');
    Route::post('/assign', 'assignPermission')->name('assignPermission');
    Route::get('/get/{id}', 'getPermissions')->name('get-permissions');
    Route::get('/get/user/{id}','getPermissionsUser')->name('get-permissions-user');
    Route::post('/assign/user','assignUserPermission')->name('assignUserPermission');
    Route::get('/user',  'assignPermissionToUser')->name('assign-permissions-to-users')->can('view_users');
});

Route::group(['middleware' => [\Spatie\Permission\Middleware\PermissionMiddleware::using('view_roles|edit_roles|update_roles|create_roles|view_users|edit_users|update_users|create_users')]], function () {
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => [\Spatie\Permission\Middleware\PermissionMiddleware::using('view_roles|edit_roles|update_roles|create_roles|view_users|edit_users|update_users|create_users')]], function () {
Route::resource('roles', RoleController::class);
});

Route::post('mark-as-read',[NotificationController::class,'markAsRead']);
Route::get('notifications',[NotificationController::class,'viewAllNotifications']);
Route::get('notification/{id}',[NotificationController::class,'deleteNotifications']);
Route::get('/notifications-count',[NotificationController::class,'getNotifications']);
Route::get('/navbar',[WebsiteController::class,'navbar'])->name('navbar.index');
Route::post('/navbar/edit',[WebsiteController::class,'navbarStore'])->name('navbar.store');

Route::controller(BlogController::class)->prefix('blog')->group(function () {
    Route::get('', 'index')->name('show-blog');
    Route::get('/{slug}/view', 'show')->name('view-blog');
    Route::get('/create', 'create')->name('create-blog');
    Route::post('/store', 'store')->name('store-blog');
    Route::get('/{slug}','edit')->name('edit-blog');
    Route::post('/{id}/update','update')->name('update-blog');
    Route::get('/{slug}/destroy',  'destroy')->name('delete-blog');
});

Route::controller(OrderController::class)->prefix('order')->group(function () {
    Route::get('', 'index')->name('show-order');
    Route::get('/{id}/view', 'show')->name('view-order');
    // Route::get('/create', 'create')->name('create-blog');
    // Route::post('/store', 'store')->name('store-blog');
    // Route::get('/{slug}','edit')->name('edit-blog');
    // Route::post('/{id}/update','update')->name('update-blog');
    Route::get('/{id}/destroy',  'destroy')->name('delete-order');
});

Route::controller(CommentController::class)->prefix('comment')->group(function () {
    Route::get('', 'index')->name('show-comment');
    Route::get('/{slug}/view', 'show')->name('view-comment');
    Route::post('/update-status', 'updateStatus');
    Route::post('/store', 'store')->name('store-comment');
});

Route::group(['middleware' => [\Spatie\Permission\Middleware\PermissionMiddleware::using('view_roles|edit_roles|update_roles|create_roles|view_users|edit_users|update_users|create_users')]], function () {
    Route::resource('categories', CategoryController::class);
    });

Route::get('add-to-log',[ActivityLogController::class,'addLog'])->name('add-log');
Route::get('logActivity',[ActivityLogController::class,'logActivity'])->name('logActivity');
Route::get('logs/{id}',[ActivityLogController::class,'delLog'])->name('delete-log');
Route::get('view/{id}',[ActivityLogController::class,'viewLog'])->name('view-log');

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('', 'index')->name('show-product');
    Route::get('/{slug}/view', 'show')->name('view-product');
    Route::post('/update-status', 'updateStatus');
    Route::get('/create', 'create')->name('create-product');
    Route::post('/store', 'store')->name('store-product');
    Route::get('/{slug}','edit')->name('edit-product');
    Route::post('/{id}/update','update')->name('update-product');
    Route::get('/{slug}/destroy',  'destroy')->name('delete-product');
});

Route::controller(ColorController::class)->prefix('colors')->group(function () {
    Route::get('', 'index')->name('show-color');
    Route::post('/store', 'store')->name('store-color');
    Route::get('/{slug}','edit')->name('edit-color');
    Route::post('/{slug}/update','update')->name('update-color');
    Route::get('/{slug}/destroy',  'destroy')->name('delete-color');
});

Route::controller(SizeController::class)->prefix('sizes')->group(function () {
    Route::get('', 'index')->name('show-size');
    Route::post('/store', 'store')->name('store-size');
    Route::get('/{slug}','edit')->name('edit-size');
    Route::post('/{slug}/update','update')->name('update-size');
    Route::get('/{slug}/destroy',  'destroy')->name('delete-size');
});

require __DIR__.'/auth.php';
