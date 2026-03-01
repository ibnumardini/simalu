<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Company;
use App\Models\School;
use Illuminate\Http\Request;

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

    public function alumnis(Request $request)
    {
        $searchQuery = trim((string) $request->query('q', ''));
        $selectedSchool = $request->query('school');
        $selectedCohort = $request->query('cohort');

        $query = Alumni::query()->with(['user', 'school', 'latestWorkHistory.company']);

        if ($searchQuery !== '') {
            $query->where(function ($builder) use ($searchQuery) {
                $builder->where('mobile', 'like', "%{$searchQuery}%")
                    ->orWhere('address', 'like', "%{$searchQuery}%")
                    ->orWhereHas('user', function ($userQuery) use ($searchQuery) {
                        $userQuery->where('first_name', 'like', "%{$searchQuery}%")
                            ->orWhere('last_name', 'like', "%{$searchQuery}%");
                    })
                    ->orWhereHas('school', function ($schoolQuery) use ($searchQuery) {
                        $schoolQuery->where('name', 'like', "%{$searchQuery}%");
                    })
                    ->orWhereHas('latestWorkHistory.company', function ($companyQuery) use ($searchQuery) {
                        $companyQuery->where('name', 'like', "%{$searchQuery}%");
                    });
            });
        }

        if (! empty($selectedSchool)) {
            $query->where('school_id', $selectedSchool);
        }

        if (! empty($selectedCohort) && is_numeric($selectedCohort)) {
            $query->whereYear('registration_at', (int) $selectedCohort);
        }

        $alumnis = $query
            ->latest('registration_at')
            ->paginate(12)
            ->appends($request->query());

        $schools = School::query()->orderBy('name')->get(['id', 'name']);

        $cohorts = Alumni::query()
            ->selectRaw('DISTINCT YEAR(registration_at) as registration_at')
            ->orderBy('registration_at', 'desc')
            ->pluck('registration_at');

        return view('landingpage.alumnis', compact(
            'alumnis',
            'schools',
            'cohorts',
            'searchQuery',
            'selectedSchool',
            'selectedCohort'
        ));
    }
}
