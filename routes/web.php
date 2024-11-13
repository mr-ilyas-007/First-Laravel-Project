<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'loginPage']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/registerSave', [AuthController::class, 'register']);
Route::post('/loged-in', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// User and admin dashboard routes
Route::get('/dashboard', [AuthController::class, 'dashboard']);

// Admin routes with 'adminCheck' middleware applied
Route::middleware(['adminCheck'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/home2', [AdminController::class, 'home'])->name('admin.dashboard.home');
    Route::get('/admin/profile/{id}', [AdminController::class, 'profile'])->name('admin.dashboard.profile');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.dashboard.settings');
    Route::post('/admin/profileUpdate/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

    //Users CRUD
    Route::resource('users', UserController::class);
    Route::get('user/trashed', [UserController::class,  'trashed'])->name('user.trashed');
    Route::patch('/user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('/user/force-delete/{id}', [UserController::class, 'forceDelete'])->name('user.forceDelete');
});

// User dashboard routes
Route::get('/home2', [DashboardController::class, 'home'])->name('dashboard.home');
Route::get('/profile/{id}', [DashboardController::class, 'profile'])->name('dashboard.profile');
Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
Route::post('/profileUpdate/{id}', [DashboardController::class, 'updateProfile'])->name('profile.update');
Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');


//Routes for contact Page
Route::get('/contacts', [ContactController::class, 'index'])->name('index');
Route::get('/contacts/add', [ContactController::class, 'create'])->name('create');
Route::post('/contacts/saveContact', [ContactController::class, 'store'])->name('store');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('edit');
Route::put('/contact/edit/{id}', [ContactController::class, 'update'])->name('update');
Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('destroy');
Route::get('/contacts/trashed', [ContactController::class, 'trashed'])->name('contact.trashed');
Route::patch('/contact/restore/{id}', [ContactController::class, 'restore'])->name('contact.restore');
Route::delete('/contact/force-delete/{id}', [ContactController::class, 'forceDelete'])->name('contact.forceDelete');


Route::get('/contact/details/{id}', [ContactController::class, 'show'])->name('contacts.show');

//Routes for Accounts CRUD
//account details -> its inside show function
Route::resource('/accounts', AccountController::class);
Route::get('/account/trashed', [AccountController::class, 'trashed'])->name('accounts.trashed');
Route::patch('/account/restore/{id}', [AccountController::class, 'restore'])->name('accounts.restore');
Route::delete('/account/force-delete/{id}', [AccountController::class, 'forceDelete'])->name('accounts.forceDelete');

//Mail Route
Route::get('send-mail', [MailController::class, 'sendMail'])->name('mail.send');
