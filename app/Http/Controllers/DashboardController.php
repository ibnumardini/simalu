<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\Utils;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    use Utils;

    public function index()
    {
        Gate::authorize('viewDashboard', User::class);

        $greeting = $this->greetingByHour();

        return view("dashboard.pages.index", compact("greeting"));
    }
}
