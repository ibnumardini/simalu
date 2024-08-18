<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/dashboard");

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');

    Route::group(['prefix' => 'master-data'], function () {
        Route::resource("schools", SchoolController::class);
        Route::get('/get-schools', [SchoolController::class, 'getSchool'])->name('get.school');

        Route::resource("companies", CompanyController::class);

        Route::get('/get-users', [UserController::class, 'getUser'])->name('get.user');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('profile', ProfileController::class);
    });

    Route::resource('alumnis', AlumniController::class);
});
