<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index'])->name('index');
Route::get('/ditail/{id}', [ItemController::class, 'show'])->name('detail');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/email/verify', [UserController::class, 'verifyEmail'])->name('verification.notice')->middleware('auth');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [LoginController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [ItemController::class, 'add'])->name('cart.add');
    Route::get('/cart', [ItemController::class, 'index'])->name('cart.index');
    Route::get('/address', [UserController::class, 'address']);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/address/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/address/update', [UserController::class, 'updateAddress'])->name('address.update');
    Route::get('/purchase', [ItemController::class, 'purchase']);
    Route::post('/purchase/confirm', [ItemController::class, 'confirm'])->name('purchase.confirm');
    Route::post('/purchase/complete', [ItemController::class, 'complete'])->name('purchase.complete');
    Route::get('/sell', [ItemController::class, 'create'])->name('sell');
    Route::post('/products', [ItemController::class, 'store'])->name('sell.store');
    Route::post('/comments', [ItemController::class, 'store'])->name('comments.store');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
});


// 認証ページ（表示用）
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 認証リンククリック後（自動で処理）

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/profile'); // 認証後の遷移先をお好みで変更
})->middleware(['auth', 'signed'])->name('verification.verify');

// 再送信処理
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '認証メールを再送しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');