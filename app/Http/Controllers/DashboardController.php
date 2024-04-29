<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\Utils;

class DashboardController extends Controller
{
    use Utils;

    public function index()
    {
        $greeting = $this->greetingByHour();

        return view("dashboard.pages.index", compact("greeting"));
    }
}
