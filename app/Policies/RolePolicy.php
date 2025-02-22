<?php
namespace App\Policies;

use App\Constants\RBAC;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ROLES, RBAC::SCOPE_READ));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ROLES, RBAC::SCOPE_CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ROLES, RBAC::SCOPE_UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ROLES, RBAC::SCOPE_DELETE));
    }
}
