<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Company;
use App\Models\School;

class LandingpageController extends Controller
{
    public function index()
    {
        $alumnisCount = Alumni::count();
        $companiesCount = Company::count();
        $schoolsCount = School::count();

        $alumnis = Alumni::with(['user', 'school', 'latestWorkHistory'])->inRandomOrder()->take(6)->get();

        return view('landingpage.index', compact('alumnisCount', 'companiesCount', 'schoolsCount', 'alumnis'));
    }
}
