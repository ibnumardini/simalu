<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPhoto;
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
        $companyData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $company->update($companyData);

        Alert::toast('Company updated successfully!', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        Alert::toast('Company deleted successfully!', 'success');

        return back();
    }
}
