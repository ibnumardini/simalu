<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\SocialAuthController;

Route::get('/', [LandingpageController::class, 'index'])->name('landingpage');
Route::get('/alumni', [LandingpageController::class, 'alumnis'])->name('landingpage.alumni');
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware('guest')->group(function () {
    Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::prefix('dashboard')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get("/", [DashboardController::class, "index"])->name('dashboard');

        Route::group(['prefix' => 'master-data'], function () {
            Route::resource("schools", SchoolController::class);
            Route::get('/get-schools', [SchoolController::class, 'getSchool'])->name('get.school');

            Route::resource("companies", CompanyController::class);
            Route::get('/get-companies', [CompanyController::class, 'getCompaniesJson'])->name('companies.get');

            Route::get('/get-users', [UserController::class, 'getUser'])->name('get.user');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::resource('roles', RoleController::class);

            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/', [ProfileController::class, 'index'])->name('index');
                Route::put('/', [ProfileController::class, 'update'])->name('update');

                Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
                    Route::get('/', [ProfileController::class, 'changePassword'])->name('index');
                    Route::put('/', [ProfileController::class, 'updatePassword'])->name('update');
                });
            });
        });

        Route::group(['prefix' => 'alumnis', 'as' => 'alumnis.'], function () {
            Route::controller(AlumniController::class)->group(function () {
                Route::group(['prefix' => '/{alumni}/work-histories', 'as' => 'work-histories.'], function () {
                    Route::get('/', 'showWorkHistories')->name('show');
                    Route::get('/create', 'createWorkHistories')->name('create');
                    Route::post('/create', 'storeWorkHistories')->name('store');

                    Route::prefix('{workHistory}')->group(function () {
                        Route::get('/edit', 'editWorkHistories')->name('edit');
                        Route::put('/update', 'updateWorkHistories')->name('update');
                        Route::delete('/', 'deleteWorkHistories')->name('delete');
                    });
                });
            });
        });

        Route::resource('alumnis', AlumniController::class);
    });
});
