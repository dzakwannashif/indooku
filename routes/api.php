<?php

use App\Http\Controllers\Databases\CategoryController;
use App\Http\Controllers\Interfaces\AuthController;
use App\Http\Controllers\Databases\PermissionController;
use App\Http\Controllers\Databases\ProductController;
use App\Http\Controllers\Databases\RoleController;
use App\Http\Controllers\Databases\RolePermissionController;
use App\Http\Controllers\Databases\UserController;
use App\Http\Controllers\Databases\UserRoleController;
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

Route::get('/product', [ProductController::class, 'index']);
Route::post('/productStore', [ProductController::class, 'store']);
Route::post('/productUpdate', [ProductController::class, 'update']);


Route::get('/category', [CategoryController::class, 'index'])->middleware('auth:sanctum');


Route::post('/categoryStore', [CategoryController::class, 'store']);
Route::post('/categoryUpdate/{id}', [CategoryController::class, 'update']);
Route::delete('/categoryDelete/{id}', [CategoryController::class, 'delete']);

Route::get('/role', [RoleController::class, 'index']);
Route::post('/roleStore', [RoleController::class, 'store']);
Route::post('/roleUpdate/{id}', [RoleController::class, 'update']);
Route::delete('/roleDelete/{id}', [RoleController::class, 'delete']);

Route::get('/user', [UserController::class, 'index']);
Route::post('/userStore', [UserController::class, 'store']);
Route::post('/userUpdate/{id}', [UserController::class, 'update']);
Route::delete('/userDelete/{id}', [UserController::class, 'delete']);

Route::get('/perm', [PermissionController::class, 'index']);
// Route::post('/permStore', [PermissionController::class, 'store'])->middleware(['permission:create-permission']);
Route::post('/permStore', [PermissionController::class, 'store']);
Route::post('/permUpdate/{id}', [PermissionController::class, 'update']);
Route::delete('/permDelete/{id}', [PermissionController::class, 'delete']);

Route::post('/giveRole/{id}', [UserRoleController::class, 'giveRole']);
Route::post('/syncRole/{id}', [UserRoleController::class, 'syncRole']);

Route::post('/syncPermission/{id}', [RolePermissionController::class, 'syncPermission']);

Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/update/{id}', [AuthController::class, 'updateUser']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
