<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisCategoryController;
use App\Http\Controllers\InventarisReportController;

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

//dashboard
Route::get('/dashboard/index', [DashboardController::class,'index']);

//inventaris
Route::group(['middleware' => 'auth'], function () {
    Route::get('/inventaris', [InventarisController::class,'index'])->name('inventaris.index');
    Route::post('/inventaris/store', [InventarisController::class,'store'])->name('inventaris.store');
    Route::get('/inventaris/item-delete{id}', [InventarisController::class,'delete'])->name('inventaris.delete');
    Route::post('/inventaris/update{id}', [InventarisController::class,'update']);
    //master category
    Route::get('/inventaris/category', [InventarisCategoryController::class,'index'])->name('inventaris.category.index');
    Route::post('/inventaris/category-store', [InventarisCategoryController::class, 'store']);
    Route::get('/inventaris/category-delete{id}', [InventarisCategoryController::class, 'delete']);
});

//inventaris problem report
Route::group(['middleware' => 'auth'], function () {
    Route::get('/inventaris/report', [InventarisReportController::class,'index']);
    Route::get('/inventaris/report/create', [InventarisReportController::class,'create']);
    Route::post('/inventaris/report/store', [InventarisReportController::class,'store']);
    Route::match(['get', 'post'],'/inventaris/report/edit/{id}', [InventarisReportController::class,'edit']);
    Route::post('/inventaris/report/update{id}', [InventarisReportController::class,'update']);
    Route::post('/inventaris/report/solution-add{id}', [InventarisReportController::class,'solution']);
    Route::post('inventaris/report/solution-update{id}', [InventarisReportController::class,'update_solution']);
    Route::get('/inventaris/report/delete{id}', [InventarisReportController::class,'delete']);
    Route::get('/inventaris/report/show/{id}', [InventarisReportController::class,'show']);
});

//Department Report
Route::group(['middleware' => 'auth'], function () {
    Route::get('/master/department', [DepartmentController::class,'index']);
    Route::post('/master/department/store', [DepartmentController::class,'store']);
    Route::get('/master/department/delete{id}', [DepartmentController::class,'delete']);
});

//search by category
Route::get('/inventaris/{id}', [InventarisController::class,'category']);
