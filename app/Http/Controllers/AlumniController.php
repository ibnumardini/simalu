<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paginate = 10;

        $query = Alumni::with(['user', 'school']);
        $searchQuery = $request->q;

        if ($request->has('q')) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('mobile', 'like', "%{$searchQuery}%")
                    ->orWhere('address', 'like', "%{$searchQuery}%")
                    ->orWhereDate('dob', 'like', "%{$searchQuery}%")
                    ->orWhereDate('registration_at', 'like', "%{$searchQuery}%")
                    ->orWhereDate('graduation_at', 'like', "%{$searchQuery}%");
            })->orWhereHas('user', function ($q) use ($searchQuery) {
                $q->where('first_name', 'like', "%{$searchQuery}%")
                    ->orWhere('last_name', 'like', "%{$searchQuery}%");
            })->orWhereHas('school', function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%");
            });
        }

        $alumnis = $query->paginate($perPage = $paginate);

        return view('dashboard.pages.alumnis.index', compact(['alumnis', 'searchQuery']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        //
    }
}
