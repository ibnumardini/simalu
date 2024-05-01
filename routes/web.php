<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/dashboard");

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::group(['prefix' => 'master-data'], function () {
        Route::resource("schools", SchoolController::class)->except("show");
        Route::resource("companies", CompanyController::class)->except("show");
    });
});
