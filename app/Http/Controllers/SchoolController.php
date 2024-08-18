<?php

namespace App\Http\Controllers;

use App\Actions\School\Utils;
use App\Models\School;
use App\Models\SchoolPhoto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            'photos' => 'nullable',
            'photos.*' => 'mimes:gif,jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $created = School::create($school);

            if ($request->has('photos')) {
                collect($school["photos"])->each(fn($photo) => $this->storePhoto($photo, $created->id));
            }

            Alert::toast('School created successfully!', 'success');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Alert::toast('School creation failed!', 'error');

            Log::error($e);
        }

        return back();
    }

    /**
     * Store a newly created photos in storage.
     */
    private function storePhoto(UploadedFile $photo, int $schoolId): void
    {
        $name = sprintf("%s.%s", Str::uuid()->toString(), $photo->extension());

        $filepath = Storage::disk("public")->putFileAs("schools", $photo, $name);

        SchoolPhoto::create([
            "path" => $filepath,
            "school_id" => $schoolId,
        ]);
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
    public function update(Request $request, School $school)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'stage' => [Rule::in([self::STAGE_FORMAL, self::STAGE_NON_FORMAL])],
            'address' => 'required|string|max:255',
        ];

        if ($hasFile = $request->hasFile('photos')) {
            $fileRules = [
                'photos' => 'required',
                'photos.*' => 'mimes:gif,jpg,jpeg,png|max:2048',
            ];

            $rules = array_merge($rules, $fileRules);
        }

        $schoolData = $request->validate($rules);

        try {
            DB::beginTransaction();

            if ($hasFile && $school->photos()->count()) {
                $school->photos()->each(fn($photo) => $this->deletePhotos($photo, 1));
            }

            if ($hasFile) {
                collect($schoolData["photos"])->each(fn($photo) => $this->storePhoto($photo, $school->id));
            }

            $school->update($schoolData);

            DB::commit();

            Alert::toast('School updated successfully!', 'success');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e);

            Alert::toast('School updation failed!', 'error');
        }

        return back();
    }

    /**
     * Remove the specified photos from storage.
     */
    private function deletePhotos(SchoolPhoto $photo, $withData = 0): void
    {
        Storage::disk("public")->delete($photo->path);

        if ($withData) {
            $photo->delete();
        }
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

    public function show(School $school): View
    {
        return view('dashboard.pages.schools.show', compact('school'));
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
