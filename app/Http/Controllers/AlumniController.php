<?php

namespace App\Http\Controllers;

use App\Actions\Alert\AlertHelper;
use App\Constants\AlertEntity;
use App\Http\Requests\Alumni\AlumniStoreRequest;
use App\Http\Requests\Alumni\AlumniUpdateRequest;
use App\Models\Alumni;
use App\Models\School;
use App\Models\WorkHistory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AlumniController extends Controller
{
    /**
     * Check if the authenticated user has an alumni record and redirect accordingly.
     */
    private function checkAlumniAndRedirect(): RedirectResponse | null
    {
        if (! Gate::check('viewAny', Alumni::class)) {
            $alumniId = Alumni::where('user_id', auth()->id())->first()?->id;
            if (! $alumniId) {
                return redirect()->route('alumnis.create');
            }

            return redirect()->route('alumnis.show', $alumniId);
        }

        return null;
    }

    /**
     * Prevent users from creating multiple alumni records unless they have management permissions.
     */
    private function cannotDuplicateAlumni(): RedirectResponse | null
    {
        $canManage = Gate::check('viewAny', Alumni::class);
        $alumni    = Alumni::where('user_id', auth()->id())->first();

        if ($alumni && ! $canManage) {
            return redirect()->route('alumnis.show', $alumni->id);
        }

        return null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | RedirectResponse
    {
        if ($redirect = $this->checkAlumniAndRedirect()) {
            return $redirect;
        }

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
    public function create(): View | RedirectResponse
    {
        Gate::authorize('create', Alumni::class);

        if ($redirect = $this->cannotDuplicateAlumni()) {
            return $redirect;
        }

        $schools = School::all();

        return view("dashboard.pages.alumnis.create", compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumniStoreRequest $request)
    {
        Gate::authorize('create', Alumni::class);

        if ($redirect = $this->cannotDuplicateAlumni()) {
            return $redirect;
        }

        $dataAlumni = $request->validated();

        if (! Gate::check('viewAny', Alumni::class)) {
            $dataAlumni['user_id'] = auth()->id();
        }

        try {
            Alumni::create($dataAlumni);

            AlertHelper::created(AlertEntity::ALUMNI);

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
        Gate::authorize('view', $alumni);

        $title = 'Delete Alumni!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('dashboard.pages.alumnis.show.detail', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        Gate::authorize('update', $alumni);

        return view('dashboard.pages.alumnis.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumniUpdateRequest $request, Alumni $alumni)
    {
        Gate::authorize('update', $alumni);

        $dataAlumni = $request->validated();

        if (! Gate::check('viewAny', Alumni::class)) {
            $dataAlumni['user_id'] = auth()->id();
        }

        try {
            Alumni::where('id', $alumni->id)->update($dataAlumni);

            AlertHelper::updated(AlertEntity::ALUMNI);

            return redirect()->route('alumnis.show', $alumni->id);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        Gate::authorize('delete', $alumni);

        try {
            $alumni->delete();

            AlertHelper::deleted(AlertEntity::ALUMNI);
        } catch (Exception $e) {
            Log::error($e);

            AlertHelper::deletionFailed(AlertEntity::ALUMNI);
        }

        return redirect()->route('alumnis.index');
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

        $workHistories->map(fn($workHistory) => Gate::authorize('view', $workHistory));

        return view('dashboard.pages.alumnis.show.work-histories.show', compact('alumni', 'workHistories'));
    }

    /**
     * Show form for create work history.
     */
    public function createWorkHistories(Alumni $alumni)
    {
        Gate::authorize('create', WorkHistory::class);

        return view('dashboard.pages.alumnis.show.work-histories.create', compact('alumni'));
    }

    /**
     * Store work history data.
     */
    public function storeWorkHistories(Alumni $alumni, Request $request)
    {
        Gate::authorize('create', WorkHistory::class);

        $input = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'resigned_at' => ['nullable', 'date'],
            'company' => ['required', 'integer', 'digits_between:1,11'],
        ]);

        $data = collect($input)->forget('company')->put('company_id', $input['company'])->put('alumni_id', $alumni->id);

        try {
            WorkHistory::create($data->toArray());

            AlertHelper::created(AlertEntity::WORK_HISTORY);
        } catch (\Exception $e) {
            Log::error($e);

            AlertHelper::creationFailed(AlertEntity::WORK_HISTORY);
        }

        return redirect()->route('alumnis.work-histories.show', $alumni->id);
    }

    /**
     * Show work history edit view.
     */
    public function editWorkHistories(Alumni $alumni, WorkHistory $workHistory)
    {
        Gate::authorize('update', $workHistory);

        return view('dashboard.pages.alumnis.show.work-histories.edit', compact('alumni', 'workHistory'));
    }

    /**
     * Update work history data.
     */
    public function updateWorkHistories(Alumni $alumni, WorkHistory $workHistory, Request $request)
    {
        Gate::authorize('update', WorkHistory::class);

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

            AlertHelper::updated(AlertEntity::WORK_HISTORY);
        } catch (\Exception $e) {
            Log::error($e);

            AlertHelper::updationFailed(AlertEntity::WORK_HISTORY);
        }

        return back();
    }

    /**
     * Delete work history data.
     */
    public function deleteWorkHistories(Alumni $alumni, WorkHistory $workHistory)
    {
        Gate::authorize('delete', $workHistory);

        try {
            $workHistory->delete();

            AlertHelper::deleted(AlertEntity::WORK_HISTORY);
        } catch (\Exception $e) {
            Log::error($e);

            AlertHelper::deletionFailed(AlertEntity::WORK_HISTORY);
        }

        return back();
    }
}
