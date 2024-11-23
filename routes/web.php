<?php

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

// Route::get('/', function () {
//     return   view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\CustomController::class, 'index'])->name('home.index');
Route::get('/about', [App\Http\Controllers\CustomController::class, 'about'])->name('home.about');
Route::get('/create-blog', [App\Http\Controllers\BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blog/store', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');

Route::get('/blog/{post}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{post}/update', [App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');
Route::delete('/blog/{post}/delete', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.delete');


Route::get('/home/mypost', [App\Http\Controllers\BlogController::class, 'mypost'])->name('home.mypost'); 

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index'); 
Route::get('/blog/{post:slug}', [App\Http\Controllers\BlogController::class, 'single'])->name('blog.single');



 Route::get('/category', [App\Http\Controllers\categoryController::class, 'index'])->name('category.index'); 
Route::get('/category/create', [App\Http\Controllers\categoryController::class, 'create'])->name('category.create'); 
Route::post('/category/store', [App\Http\Controllers\categoryController::class, 'store'])->name('category.store');
Route::get('/category/{cat}/edit', [App\Http\Controllers\categoryController::class, 'edit'])->name('category.edit');


Route::put('/category/{editCat}/update', [App\Http\Controllers\categoryController::class, 'update'])->name('category.update');
Route::delete('/category/{cat}/delete', [App\Http\Controllers\categoryController::class, 'destroy'])->name('category.delete');
