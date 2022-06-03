<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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

Route::prefix("users")->middleware(["guest"])->name("users.")->group(function () {
    Route::get("/login", [LoginController::class, 'create'])->name('login-page');
    Route::post("/login", [LoginController::class, 'store'])->middleware(['throttle:10,1'])->name('login');
    Route::post("/logout", [LoginController::class, 'destroy'])
        ->withoutMiddleware(['guest'])->middleware(['auth'])->name('logout');

    Route::get("/forgot-password", [ForgotPasswordController::class, 'edit'])->name('forgot-password-page');
    Route::patch("/forgot-password", [ForgotPasswordController::class, 'update'])->name('forgot-password');
});

Route::middleware("auth")->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("/");

    Route::resource("products", ProductController::class);
    Route::resource("customers", CustomerController::class);

    Route::resource("sales", SaleController::class);
    Route::get("/sale-profits", [SaleController::class, "profitIndex"])->name("sale-profits.index");

    Route::resource("users", UserController::class)->except(['update']);
    Route::post("users/{user:id}/update", [UserController::class, "update"])->name("users.update");

    Route::resource("roles", RoleController::class);
    Route::get("permissions", PermissionController::class)->name("permissions.index");
});





// for testing purposes
Route::get("/test", function (Request $request) {
    return inertia()->render('Test');
});
Route::post("/test", function (Request $request) {
});
