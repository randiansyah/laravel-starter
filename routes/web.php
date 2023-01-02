<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return redirect('/dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/permissions', [PermissionController::class, 'index'])->middleware('auth');
Route::post('/permissions', [PermissionController::class, 'store'])->middleware('auth');
Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->middleware('auth');
Route::patch('/permissions/{permission}', [PermissionController::class, 'update'])->middleware('auth');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('auth');
Route::resource('/roles', RoleController::class)->middleware('auth');
Route::resource('/users', UserController::class)->middleware('auth');
Route::get('/my-account', [MyAccountController::class, 'show'])->middleware('auth');
Route::post('/my-account', [MyAccountController::class, 'updateAccount'])->middleware('auth');
Route::post('/my-account/update-password', [MyAccountController::class, 'updatePassword'])->middleware('auth');
//category
Route::resource('/category', CategoryController::class)->middleware('auth');
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/category', [CategoryController::class, 'store'])->middleware('auth');
Route::get('/category/{id}', [CategoryController::class, 'edit'])->middleware('auth');
Route::patch('/category/{category}', [CategoryController::class, 'update'])->middleware('auth');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('auth');
//task
Route::resource('/task', TaskController::class)->middleware('auth');
Route::get('/task', [TaskController::class, 'index'])->middleware('auth');
Route::post('/task', [TaskController::class, 'store'])->middleware('auth');
Route::get('/task/{id}', [TaskController::class, 'edit'])->middleware('auth');
Route::patch('/task/{task}', [TaskController::class, 'update'])->middleware('auth');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->middleware('auth');
Route::get('/task/{id}/do', [TaskController::class, 'do'])->middleware('auth');
//todos
Route::post('/todo', [TodoController::class, 'store'])->middleware('auth');