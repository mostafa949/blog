<?php

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


use Illuminate\Support\Facades\Route;

Route::get('/blogtest', function () {
    return categoryFilePath('gg');
});

Route::prefix('blog')->name('blog.')->group(function() {
    Route::resource('/', 'BlogController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/posts', 'PostsController');
});
