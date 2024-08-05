<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/dashboard");

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::group(['prefix' => 'master-data'], function () {
        Route::resource("schools", SchoolController::class)->except("show");
        Route::get('/get-schools', [SchoolController::class, 'getSchool'])->name('get.school');

        Route::get('/get-users', [UserController::class, 'getUser'])->name('get.user');

        Route::resource("companies", CompanyController::class);
    });

    Route::resource('alumnis', AlumniController::class);
});
