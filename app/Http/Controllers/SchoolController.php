<?php

namespace App\Http\Controllers;

use App\Actions\School\Utils;
use App\Models\School;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SchoolController extends Controller
{
    use Utils;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = 10;
        $searchQuery = $request->q;

        if ($request->has('q')) {
            $schools = School::where('name', 'like', "%{$searchQuery}%")
                ->paginate($paginate)
                ->withQueryString();
        } else {
            $schools = School::paginate($paginate)->withQueryString();
        }

        return view('dashboard.pages.schools.index', compact('schools', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $school = $request->validate([
            'name' => 'required|string|max:255',
            'stage' => [Rule::in([self::STAGE_FORMAL, self::STAGE_NON_FORMAL])],
            'address' => 'required|string|max:255',
        ]);

        School::create($school);

        Alert::toast('School created successfully!', 'success');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $school = School::findOrFail($id);

        return view('dashboard.pages.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $school = $request->validate([
            'name' => 'required|string|max:255',
            'stage' => [Rule::in([self::STAGE_FORMAL, self::STAGE_NON_FORMAL])],
            'address' => 'required|string|max:255',
        ]);

        School::findOrFail($id)->update($school);

        Alert::toast('School updated successfully!', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        School::findOrFail($id)->delete();

        Alert::toast('School deleted successfully!', 'success');

        return back();
    }

    public function getSchool(Request $request): JsonResponse
    {
        $search = $request->input('search');

        $schools_query = School::query();

        if ($search) {
            $schools_query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('stage', 'like', '%' . $search . '%');
        }

        $schools = $schools_query->limit(5)->get();


        return response()->json($schools);
    }
}
