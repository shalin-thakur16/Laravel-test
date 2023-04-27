<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/edit-profile', [App\Http\Controllers\Auth\ProfileController::class, 'showEditForm'])->name('updateProfile')->middleware(['auth']);
Route::post('/update-user', [App\Http\Controllers\Auth\ProfileController::class, 'updateUser'])->name('updateUser')->middleware(['auth']);
Route::any('category/create', [App\Http\Controllers\CategoryController::class, 'createCategory'])->name('createCategory');
Route::get('category/show', [App\Http\Controllers\CategoryController::class, 'showCategory'])->name('showCategory');
Route::get('category-list/show', [App\Http\Controllers\CategoryController::class, 'getCategories'])->name('categoriesList');
