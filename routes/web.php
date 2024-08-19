<?php

use App\Http\Controllers\JustOrangeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [JustOrangeController::class , 'index']);
Route::group(['prefix' => '/product'],function(){
Route::get('/' , [JustOrangeController::class, 'getProducts'])->name('products');
    Route::get('/{slug}' , [JustOrangeController::class , 'getProductDetail'])->name('product.detail');
});
Route::group(['prefix' => '/post'] , function(){
    Route::get('/',[JustOrangeController::class , 'getPosts'])->name('posts');
    Route::get('/{slug}' , [JustOrangeController::class , 'getPostDetail'])->name('post.detail');
});
Route::get('/about' , [JustOrangeController::class , 'getAbout'])->name('about');
Route::get('/contact' , [JustOrangeController::class , 'getContact'])->name('contact');
