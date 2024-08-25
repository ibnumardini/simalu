<?php

namespace App\Http\Controllers;

use App\Http\Requests\Alumni\AlumniStoreRequest;
use App\Http\Requests\Alumni\AlumniUpdateRequest;
use App\Models\Alumni;
use App\Models\School;
use App\Models\WorkHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function create(): View
    {
        $schools = School::all();

        return view("dashboard.pages.alumnis.create", compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumniStoreRequest $request)
    {
        $dataAlumni = $request->validated();

        try {

            Alumni::create($dataAlumni);

            Alert::toast('Alumni created successfully!', 'success');

            return redirect()->route('alumnis.index');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        return view('dashboard.pages.alumnis.show.detail', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        return view('dashboard.pages.alumnis.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumniUpdateRequest $request, Alumni $alumni)
    {
        $dataAlumni = $request->validated();

        try {

            Alumni::where('id', $alumni->id)->update($dataAlumni);

            Alert::toast('Alumni updated successfully!', 'success');

            return redirect()->route('alumnis.index');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        School::findOrFail($alumni->id)->delete();

        Alert::toast('Alumni deleted successfully!', 'success');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function showWorkHistories(Alumni $alumni, Request $request)
    {
        $paginate = 10;
        $searchQuery = $request->q;

        $workHistories = WorkHistory::where('alumni_id', $alumni->id)->when($request->has('q'), function ($query) use ($searchQuery, $paginate) {
            return $query->where('name', 'like', "%{$searchQuery}%")->paginate($paginate)->withQueryString();
        }, function ($query) use ($paginate) {
            return $query->paginate($paginate)->withQueryString();
        });

        return view('dashboard.pages.alumnis.show.work-histories.show', compact('alumni', 'workHistories'));
    }

    /**
     * Show form for create work history.
     */
    public function createWorkHistories(Alumni $alumni)
    {
        return view('dashboard.pages.alumnis.show.work-histories.create', compact('alumni'));
    }

    /**
     * Store work history data.
     */
    public function storeWorkHistories(Alumni $alumni, Request $request)
    {
        $input = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'resigned_at' => ['nullable', 'date'],
            'company' => ['required', 'integer', 'digits_between:1,11'],
        ]);

        $data = collect($input)->forget('company')->put('company_id', $input['company'])->put('alumni_id', $alumni->id);

        try {
            WorkHistory::create($data->toArray());

            Alert::toast('Work history creation successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('Work history creation failed!', 'error');
        }

        return back();
    }

    /**
     * Show work history edit view.
     */
    public function editWorkHistories(Alumni $alumni, WorkHistory $workHistory)
    {
        return view('dashboard.pages.alumnis.show.work-histories.edit', compact('alumni', 'workHistory'));
    }

    /**
     * Update work history data.
     */
    public function updateWorkHistories(Alumni $alumni, WorkHistory $workHistory, Request $request)
    {
        $input = $request->validate([
            'position' => ['nullable', 'string', 'max:255'],
            'start_at' => ['nullable', 'date'],
            'resigned_at' => ['nullable', 'date'],
            'company' => ['nullable', 'integer', 'digits_between:1,11'],
        ]);

        $request->merge([
            'position' => $input['position'] ?? $workHistory->position,
            'start_at' => $input['start_at'] ?? $workHistory->start_at,
            'company' => $input['company'] ?? $workHistory->company,
        ]);

        $data = collect($request->all())->forget(['_token', '_method', 'company'])->put('company_id', $input['company']);

        try {
            $workHistory->update($data->toArray());

            Alert::toast('Work history updation successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('Work history updation failed!', 'error');
        }

        return back();
    }

    /**
     * Delete work history data.
     */
    public function deleteWorkHistories(Alumni $alumni, WorkHistory $workHistory)
    {
        try {
            $workHistory->delete();

            Alert::toast('Work history deletion successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            Alert::toast('Work history deletion failed!', 'error');
        }

        return back();
    }
}
