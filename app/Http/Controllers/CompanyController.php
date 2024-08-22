<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = 10;
        $searchQuery = $request->q;

        if ($request->has('q')) {
            $companies = Company::where('name', 'like', "%{$searchQuery}%")
                ->paginate($paginate)
                ->withQueryString();
        } else {
            $companies = Company::paginate($paginate)->withQueryString();
        }

        return view('dashboard.pages.companies.index', compact('companies', 'searchQuery'));
    }

    public function show(Company $company)
    {
        return view('dashboard.pages.companies.show', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'photos' => 'required',
            'photos.*' => 'mimes:gif,jpg,jpeg,png|max:2048',
        ]);

        $created = Company::create($company);

        collect($company["photos"])->each(fn($photo) => $this->storePhoto($photo, $created->id));

        Alert::toast('Company created successfully!', 'success');

        return back();
    }

    /**
     * Store a newly created photos in storage.
     */
    private function storePhoto(UploadedFile $photo, int $companyId): void
    {
        $name = sprintf("%s.%s", Str::uuid()->toString(), $photo->extension());

        $filepath = Storage::disk("public")->putFileAs("companies", $photo, $name);

        CompanyPhoto::create([
            "path" => $filepath,
            "company_id" => $companyId,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('dashboard.pages.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];

        // merge photo validation rules, when photos are provided
        if ($newPhotos = collect($request->photos)->first()) {
            $fileRules = [
                'photos' => 'required',
                'photos.*' => 'mimes:gif,jpg,jpeg,png|max:2048',
            ];

            $rules = array_merge($rules, $fileRules);
        }

        // do validation
        $companyData = $request->validate($rules);

        // delete old photos if there are new photos
        if ($newPhotos && $company->photos()->count()) {
            $company->photos()->each(fn($photo) => $this->deletePhotos($photo, 1));
        }

        // save the new photo if you have one
        if ($newPhotos) {
            collect($companyData["photos"])->each(fn($photo) => $this->storePhoto($photo, $company->id));
        }

        $company->update($companyData);

        Alert::toast('Company updated successfully!', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $photos = $company->photos();

        if ($photos->count()) {
            $photos->each(fn($photo) => $this->deletePhotos($photo));
        }

        $company->delete();

        Alert::toast('Company deleted successfully!', 'success');

        return back();
    }

    /**
     * Remove the specified photos from storage.
     */
    private function deletePhotos(CompanyPhoto $photo, $withData = 0): void
    {
        Storage::disk("public")->delete($photo->path);

        if ($withData) {
            $photo->delete();
        }
    }

    public function getCompaniesJson(Request $request): JsonResponse
    {
        $q = $request->input('q', '');

        $companies = Company::when($q, function ($query) use ($q) {
            return $query->where('name', 'like', '%' . $q . '%');
        })->limit(5)->get();

        return response()->json($companies);
    }
}
