<?php
namespace App\Http\Controllers;

use App\Constants\RBAC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('view', Role::class);

        $paginate    = 10;
        $searchQuery = $request->q;

        if ($request->has('q')) {
            $roles = Role::where('name', 'like', "%{$searchQuery}%")
                ->paginate($paginate)
                ->withQueryString();
        } else {
            $roles = Role::paginate($paginate)->withQueryString();
        }

        $roles->map(fn($role) => Gate::authorize('view', $role));

        return view('dashboard.pages.settings.roles.index', compact('roles', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Role::class);

        $permissions = [];

        foreach (Permission::all() as $value) {
            [$page, $scope] = explode("/", $value->name);

            $permissions[$page][] = [$value->id, $scope];
        }

        return view('dashboard.pages.settings.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Role::class);

        $input = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'integer', 'max_digits:11'],
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create([
                'name'  => $input['name'],
                'guard' => RBAC::GUARD_WEB,
            ]);

            foreach ($input['permissions'] ?? [] as $id) {
                $permission = Permission::findById($id);

                $role->givePermissionTo($permission);
            }

            DB::commit();

            Alert::toast('Role created successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            DB::rollBack();

            Alert::toast('Role creation failed!', 'error');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('update', Role::class);

        $role = Role::findById($id);

        $permMap = $role->permissions->pluck('id', 'name')->toArray();

        $permissions = [];

        foreach (Permission::all() as $value) {
            [$page, $scope] = explode("/", $value->name);

            $permissions[$page][] = [$value->id, $scope, $permMap[$value->name] ?? 0];
        }

        return view('dashboard.pages.settings.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('update', Role::class);

        $input = $request->validate([
            'name'          => ['nullable', 'string', 'max:255'],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'integer', 'max_digits:11'],
        ]);

        try {
            $role = Role::findById($id);
            if (! $role) {
                throw new \Exception('role not found', 404);
            }

            DB::beginTransaction();

            $role->update([
                'name' => $input['name'] ?? $role->name,
            ]);

            $role->permissions()->detach();

            foreach ($input['permissions'] ?? [] as $id) {
                $permission = Permission::findById($id);

                $role->givePermissionTo($permission);
            }

            DB::commit();

            Alert::toast('Role updated successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            DB::rollBack();

            Alert::toast('Role update failed!', 'error');
        }

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete', Role::class);

        try {
            DB::beginTransaction();

            $role = Role::findById($id);

            if ($role->name === RBAC::ROLE_SUPERADMIN) {
                throw new \Exception("can't delete superadmin role", 400);
            }

            $role->delete();

            DB::commit();

            Alert::toast('Role deleted successfully!', 'success');
        } catch (\Exception $e) {
            Log::error($e);

            DB::rollBack();

            Alert::toast('Role deletion failed!', 'error');
        }

        return back();
    }
}
