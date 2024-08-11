<?php

namespace Database\Seeders;

use App\Constants\RBAC;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();
        Permission::truncate();

        $rbacConfig = config('rbac');

        foreach ($rbacConfig as $roleName => $permissions) {
            $role = Role::create([
                'name' => $roleName,
                'guard_name' => RBAC::GUARD_WEB,
            ]);

            foreach ($permissions as $permission) {
                $permissionName = sprintf('%s/%s', $permission['page'], $permission['scope']);
                $rolePermission = Permission::findOrCreate($permissionName);

                $role->givePermissionTo($rolePermission);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
