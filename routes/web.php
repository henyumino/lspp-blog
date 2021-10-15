<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SepedaController;

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

Route::get('/', [PostController::class, 'showAllPost']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);



// middleware user

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // post
    Route::get('/dashboard/post', [UserController::class, 'index'])->name('dashboard');
    Route::get('/post/add', [PostController::class, 'index'])->name('addpost');
    Route::post('/post/add', [PostController::class, 'store'])->name('storePost');
    Route::get('/post/{id}/edit', [PostController::class, 'edit']);
    Route::put('/post/{id}/edit', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);

    

    // category
    Route::get('/dashboard/category', [UserController::class, 'showCategory'])->name('category');
    Route::get('/category/add', [UserController::class, 'showCategoryForm'])->name('showCategory');
    Route::post('/category/add', [UserController::class, 'addCategory'])->name('addCategory');
    Route::get('/category/{id}/edit', [UserController::class, 'showEditCategory']);
    Route::put('/category/{id}/edit', [UserController::class, 'updateCategory']);
    Route::delete('/category/{id}', [UserController::class, 'deleteCategory']);

    //Comment
    Route::post('/comment/{post_id}', [CommentController::class, 'store']);
    Route::get('/comment/{id}/edit', [CommentController::class, 'edit']);
    Route::put('/comment/{id}/edit', [CommentController::class, 'update']);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
    
    // sepeda

    Route::get('/dashboard/sepeda', [SepedaController::class, 'showSepeda'])->name('sepeda');
    Route::get('/sepeda/add', [SepedaController::class, 'addSepeda'])->name('addSepeda');
    Route::post('/sepeda/add', [SepedaController::class, 'store']);
    Route::get('/sepeda/{id}/edit', [SepedaController::class, 'edit']);
    Route::put('/sepeda/{id}/edit', [SepedaController::class, 'update']);
    Route::delete('/sepeda/{id}', [SepedaController::class, 'destroy']);
    

});

Route::get('/post/{slug}', [PostController::class, 'show']);