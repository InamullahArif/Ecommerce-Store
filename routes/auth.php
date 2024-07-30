<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

// Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register123', [RegisteredUserController::class, 'store'])->name('register123');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login123', [AuthenticatedSessionController::class, 'store'])->name('login123');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
                
// });

Route::middleware('auth')->group(function () {
    // Route::get('/dashboardOne', function () {
    //     return view('dashboard.index');
    Route::get('/dashboardOne', [DashboardController::class, 'index'])
                ->name('dashboard.one');
    // Route::get('/all-user', function () {
    //     return view('dashboard.all-user');
    // })->name('all-user');
    // Route::get('/add-new-user', function () {
    //     return view('dashboard.add-new-user');
    // })->name('add-new-user');
    // Route::get('/add-new-user', [UserController::class, 'showUser'])
    //             ->name('add-new-user');
    //             // Route::get('get-permissions/{id}', [RoleController::class, 'getPermissions'])
    //             // ->name('getPermissions');
    // Route::get('/create-roles', function () {
    //     return view('dashboard.create-role');
    // })->name('create-roles');
    // Route::get('all-user', [UserController::class, 'index'])->name('all-user')->can('view_users');
    // Route::get('editUser/{id}', [UserController::class, 'getUser'])->name('editUser')->can('edit_users');
    // Route::post('updateUser/{id}', [UserController::class, 'updateUser'])->name('updateUser')->can('edit_users');
    // Route::post('updateRole/{id}', [RoleController::class, 'updateRole'])->name('updateRole');
    // Route::get('viewUser/{id}', [UserController::class, 'getUser'])->name('viewUser')->can('view_users');
    // Route::post('addUser', [UserController::class, 'store'])->name('addUser')->can('create_users');
    // Route::get('editRole/{id}', [RoleController::class, 'getRole'])->name('editRole');
    // Route::post('addRole', [RoleController::class, 'store'])->name('addRole');
    // Route::get('deleteUser/{id}', [UserController::class, 'delete'])->name('deleteUser');
    // Route::get('deleteRole/{id}', [RoleController::class, 'delete'])->name('deleteRole');
    // Route::get('assign-permissions', [RoleController::class, 'showPermissions'])->name('assign-permissions');
    // Route::post('/assignPermission', [RoleController::class, 'assignPermission'])->name('assignPermission');
    // Route::get('/get-permissions/{id}', [RoleController::class, 'getPermissions'])->name('get-permissions');
    // Route::get('/get-permissions-user/{id}', [RoleController::class, 'getPermissionsUser'])->name('get-permissions-user');
    // Route::post('/assignUserPermission', [RoleController::class, 'assignUserPermission'])->name('assignUserPermission');
    // Route::get('user-profile/{id}', [RoleController::class, 'showUserProfile'])->name('user-profile');
    // Route::post('updateUserProfile/{id}', [UserController::class, 'updateUserProfile'])->name('updateUserProfile');
    // Route::get('/assign-permissions-to-users', [RoleController::class, 'assignPermissionToUser'])->name('assign-permissions-to-users')->can('view_users');
    // Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    // Route::get('/all-roles', [RoleController::class, 'index'])->name('all-roles');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
