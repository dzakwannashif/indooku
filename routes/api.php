<?php

use App\Http\Controllers\Databases\CategoryController;
use App\Http\Controllers\Interfaces\AuthController;
use App\Http\Controllers\Databases\PermissionController;
use App\Http\Controllers\Databases\ProductController;
use App\Http\Controllers\Databases\RoleController;
use App\Http\Controllers\Databases\RolePermissionController;
use App\Http\Controllers\Databases\UserController;
use App\Http\Controllers\Databases\UserRoleController;
use App\Http\Controllers\Web\UserWebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//! Product
Route::get('/product', [ProductController::class, 'index']);

Route::post('/productStore', [ProductController::class, 'store']);
Route::post('/productUpdate/{id}', [ProductController::class, 'update']);
Route::post('/productDelete/{id}', [ProductController::class, 'delete']);

//! Category
Route::get('/category', [CategoryController::class, 'index']);

Route::post('/categoryStore', [CategoryController::class, 'store']);
Route::post('/categoryUpdate/{id}', [CategoryController::class, 'update']);
Route::delete('/categoryDelete/{id}', [CategoryController::class, 'delete']);

//! Role
Route::get('/role', [RoleController::class, 'index']);

Route::post('/roleStore', [RoleController::class, 'store']);
Route::post('/roleUpdate/{id}', [RoleController::class, 'update']);
Route::delete('/roleDelete/{id}', [RoleController::class, 'delete']);

//! User
Route::get('/user', [UserController::class, 'index']);

Route::post('/userStore', [UserController::class, 'store']);
Route::post('/userUpdate/{id}', [UserController::class, 'update']);
Route::delete('/userDelete/{id}', [UserController::class, 'delete']);

//!perm
Route::get('/perm', [PermissionController::class, 'index']);

Route::post('/permStore', [PermissionController::class, 'store'])->middleware(['auth', 'permission:create-permission']);
Route::post('/permUpdate/{id}', [PermissionController::class, 'update']);
Route::delete('/permDelete/{id}', [PermissionController::class, 'delete']);

//! Give n Sync Role
Route::post('/giveRole/{id}', [UserRoleController::class, 'giveRole']);
Route::post('/syncRole/{id}', [UserRoleController::class, 'syncRole']);

//! Sync Perm
Route::post('/syncPermission/{id}', [RolePermissionController::class, 'syncPermission']);


//! AUTH
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/update/user', [AuthController::class, 'update'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
