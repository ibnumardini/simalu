<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/dashboard");

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"]);
});
