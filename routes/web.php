<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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
    return view('/login.index');
})->name('login');

//login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//user
Route::get('/user/index', [UserController::class, 'index'])->middleware('auth');
Route::get('/user/create', [UserController::class, 'create'])->middleware('admin');
Route::match(['get', 'post'], '/user/edit/user-{id}', [UserController::class,'edit']);
Route::post('/user/edit/user-{id}', [UserController::class,'update']);
Route::post('/user/store', [UserController::class, 'store']);
Route::get('/user-delete{id}', [UserController::class, 'delete']);

//profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [ProfileController::class,'index'])->name('profile.index');
    Route::patch('profile', [ProfileController::class,'update'])
        ->name('profile.update');
});

//changePassword
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/change', [PasswordController::class,'index'])->name('password.index');
    Route::patch('password/change', [PasswordController::class,'update'])
        ->name('password.update');
});