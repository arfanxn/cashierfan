<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\EmailController as AuthEmailController;
use App\Http\Controllers\Auth\PasswordController as AuthPasswordController;
use App\Http\Controllers\Auth\VerificationCodeController;
use App\Models\User;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

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
    Route::delete("/logout", [LoginController::class, 'destroy'])
        ->withoutMiddleware(['guest'])->middleware(['auth'])->name('logout');

    Route::get("/forgot-password", [ForgotPasswordController::class, 'edit'])->name('forgot-password-page');
    Route::patch("/forgot-password", [ForgotPasswordController::class, 'update'])
        ->middleware(['verify_vc'])->name('forgot-password');
});

Route::middleware("auth")->group(function () {
    Route::get("/", DashboardController::class)->name("/");

    Route::resource("products", ProductController::class)->except(['update']);
    Route::post("products/{product:id}/update", [ProductController::class, "update"])->name("products.update");
    Route::resource("customers", CustomerController::class);

    Route::resource("sales", SaleController::class);
    Route::get("sales/{sale:invoice}/invoice", [SaleController::class, "invoice"])
        ->withoutMiddleware("auth")->name("sales.invoice");
    Route::get("/sale-profits", [SaleController::class, "profitIndex"])->name("sale-profits.index");

    Route::resource("users", UserController::class)->except(['update']);
    Route::post("users/{user:id}/update", [UserController::class, "update"])->name("users.update");

    Route::prefix("auth")->name("auth.")->group(function () {
        Route::get("/profile/edit", [ProfileController::class, "edit"])->name("profile.edit");
        Route::post("/profile/update", [ProfileController::class, "update"])->name("profile.update");

        Route::get("/email/edit", [AuthEmailController::class, "edit"])->name("email.edit");
        Route::patch("/email/update", [AuthEmailController::class, "update"])->middleware(['verify_vc'])
            ->name("email.update");

        Route::get("/password/edit", [AuthPasswordController::class, "edit"])->name("password.edit");
        Route::patch("/password/update", [AuthPasswordController::class, "update"])->name("password.update");

        Route::post("/verification-code/send", [VerificationCodeController::class, "send"])
            ->middleware("throttle:1,1")
            ->withoutMiddleware("auth")
            ->name("vc.send");
    });

    Route::resource("roles", RoleController::class)->except(['show']);
    Route::get("permissions", PermissionController::class)->name("permissions.index");
});





// for testing purposes
Route::get("/test", function (Request $request) {
    \App\Services\VerificationCodeService::make("arfan2173@gmail.com")->send();
    // return (new VerificationCodeNotification("121212", now()->addMinutes(30)))->toMail(User::first());
    return Inertia::render("Test");
});
Route::post("/test", function (Request $request) {
    return response(["hello" => "world"]);
})->middleware(['throttle:1,1']);
