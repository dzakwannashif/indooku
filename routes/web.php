<?php

use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\CategoryWebController;
use App\Http\Controllers\Web\DashWebController;
use App\Http\Controllers\Web\ProductWebController;
use App\Http\Controllers\Web\UserWebController;
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
    return view('login.login');
})->name('index');
// Route::middleware(a)

Route::middleware(['role:admin|karyawan'])->group(function () {

    Route::get('/logout', [AuthWebController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashWebController::class, 'index'])->name('dash.data');

    Route::get('/category', [CategoryWebController::class, 'tampil'])->name('category.data');

    Route::get('/categoryCreate', [CategoryWebController::class, 'tampilCreate'])->name('category.tampilanStore');
    Route::post('/categoryCreate', [CategoryWebController::class, 'store'])->name('category.store');

    Route::get('/categoryEdit/{id}', [CategoryWebController::class, 'tampilEdit'])->name('category.tampilanEdit');
    Route::post('/categoryEdit/{id}', [CategoryWebController::class, 'update'])->name('category.update');

    Route::get('/categoryDelete/{id}', [CategoryWebController::class, 'delete'])->name('category.delete');

    Route::get('/products', [ProductWebController::class, 'index'])->name('product.data');

    Route::get('/productsCreate', [ProductWebController::class, 'tampilanStore'])->name('product.tampilanStore');
    Route::post('/productsCreate', [ProductWebController::class, 'store'])->name('product.store');

    Route::get('/productsEdit{id}', [ProductWebController::class, 'tampilanEdit'])->name('product.tampilanEdit');
    Route::post('/productsEdit{id}', [ProductWebController::class, 'update'])->name('product.update');

    Route::get('/delete{id}', [ProductWebController::class, 'delete'])->name('product.delete');

    Route::get('/user', [UserWebController::class, 'tampilanIndex'])->name('user.data');

    Route::get('/userEdit{id}', [UserWebController::class, 'tampilanEdit'])->name('user.tampilanEdit');
    Route::post('/userEdit{id}', [UserWebController::class, 'edit'])->name('user.edit');
});

Route::get('/login', [AuthWebController::class, 'loginPage'])->name('login.page')->middleware('guest');
Route::post('/login', [AuthWebController::class, 'login'])->name('login.data')->middleware('guest');
