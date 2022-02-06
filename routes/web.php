<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

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

Route::get('/test', function () {
    if (auth()->guard('web')->check()) {
        return 'yes web';
    } elseif (auth()->guard('admin')->check()) {
        return 'yes admin';
    } else {
        return 'no auth';
    }
});


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register.user');
    Route::post('/register', [AuthController::class, 'storeUser'])->name('register.user');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:web,admin'])->group(function () {
    Route::get('/user', [AuthController::class, 'getAuthUser']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Route::get('/', [PagesController::class, 'index']);
Route::get('/', [BlogController::class, 'index'])->name('home');

//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

