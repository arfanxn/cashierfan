<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
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
//     return view('welcome');
// });
Route::inertia("/", 'Dashboard')->name("/");

// Route::prefix("products")->name("product.")->group(function () {
//     Route::get("", [ProductController::class, "index"])->name("index");
//     Route::get("create", [ProductController::class, "create"])->name("create");
// });

Route::resource("products", ProductController::class);
Route::resource("customers", CustomerController::class);

Route::resource("users", UserController::class);
Route::resource("roles", RoleController::class);
Route::get("permissions", PermissionController::class)->name("permissions.index");

Route::resource("sales", SaleController::class);
// Route::prefix("sales")->name("sales.")->group(function () {
Route::get("/sale-profits", [SaleController::class, "profitIndex"])->name("sale-profits.index");
// });

Route::prefix("users")->name("users.")->group(function () {
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::get("/forgot-password", [AuthController::class, 'forgotPassword'])->name('forgot-password');
});

Route::inertia("/test", 'Test')->name("test");
