<?php

namespace App\Policies;

use App\Constants\RBAC;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewDashboard(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_DASHBOARD, RBAC::SCOPE_READ));
    }
}
