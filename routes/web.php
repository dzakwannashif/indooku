<?php

use App\Http\Controllers\Web\CategoryWebController;
use App\Http\Controllers\Web\ProductWebController;
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

Route::get('/', function () {
    return view('layouts.master');
})->name('index');
// Route::middleware(a)
Route::get('/category', [CategoryWebController::class, 'tampil'])->name('category.data');

Route::get('/categoryCreate', [CategoryWebController::class, 'tampilCreate'])->name('category.tampilanStore');
Route::post('/categoryCreate', [CategoryWebController::class, 'store'])->name('category.store');

Route::get('/categoryEdit/{id}', [CategoryWebController::class, 'tampilEdit'])->name('category.tampilanEdit');
Route::post('/categoryEdit/{id}', [CategoryWebController::class, 'update'])->name('category.update');

Route::get('/categoryDelete/{id}', [CategoryWebController::class, 'delete'])->name('category.delete');

Route::get('/products', [ProductWebController::class, 'index'])->name('product.data');

Route::get('/productsCreate', [ProductWebController::class, 'tampilanStore'])->name('product.tampilanStore');
