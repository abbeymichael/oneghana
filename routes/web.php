<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\AdClickController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\BusinessSearch;
use App\Livewire\BusinessShow;
use App\Livewire\BusinessRegister;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Owner\BusinessManager;
use App\Livewire\Owner\ProductManager;
use App\Livewire\Admin\ModerationQueue;
use App\Livewire\Admin\CategoryManager;
use App\Livewire\Admin\CurrencyManager;
use App\Livewire\Admin\AdCampaignManager;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', Home::class)->name('home');
Route::get('/search', BusinessSearch::class)->name('business.search');
Route::get('/businesses/{business}', BusinessShow::class)->name('business.show');
Route::get('/ads/{campaign}/click', [AdClickController::class, 'click'])->name('ads.click');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/register-business', BusinessRegister::class)->name('business.register');

    Route::prefix('/owner')->name('owner.')->group(function () {
        Route::get('/business/{business}/edit', BusinessManager::class)->name('business.edit');
        Route::get('/business/{business}/products', ProductManager::class)->name('business.products');
    });

    Route::prefix('/admin')->name('admin.')->middleware('can:admin')->group(function () {
        Route::get('/moderation', ModerationQueue::class)->name('moderation');
        Route::get('/categories', CategoryManager::class)->name('categories');
        Route::get('/currencies', CurrencyManager::class)->name('currencies');
        Route::get('/ad-campaigns', AdCampaignManager::class)->name('ad-campaigns');
    });
});

// Email verification
Route::get('/email/verify', VerifyEmail::class)->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

// Logout
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');
