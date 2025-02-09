<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

// お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::get('/confirm', function () {
    return redirect()->route('contact.index');
});
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 管理画面（ログインが必要）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// ログイン・登録ページ（Fortifyのデフォルトルート）
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    Route::get('/admin/contacts/{id}', [AdminController::class, 'show'])->name('admin.contacts.show');
    Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::get('/admin/contacts/export', [AdminController::class, 'export'])->name('admin.contacts.export');
});
