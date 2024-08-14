<?php

namespace Database\Seeders;

use App\Constants\RBAC;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * User generator with default role.
         *
         * email: user@email.com
         * pass: user123
         * role: user
         *
         * email: admin@email.com
         * pass: admin123
         * role: admin
         *
         * email: superadmin@email.com
         * pass: superadmin123
         * role: superadmin
         */
        collect([
            RBAC::ROLE_USER,
            RBAC::ROLE_ADMIN,
            RBAC::ROLE_SUPERADMIN,
        ])->each(function ($role) {
            $user = User::create([
                'first_name' => Str::title($role),
                'last_name' => 'Simalu',
                'email' => sprintf('%s@email.com', $role),
                'password' => Hash::make(sprintf('%s123', $role)),
            ]);

            $user->assignRole($role);
        });
    }
}
