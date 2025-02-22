<?php
namespace App\Policies;

use App\Constants\RBAC;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function viewDashboard(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_DASHBOARD, RBAC::SCOPE_READ));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_PROFILE, RBAC::SCOPE_READ));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_PROFILE, RBAC::SCOPE_UPDATE));
    }
}
