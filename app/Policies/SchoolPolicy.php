<?php
namespace App\Policies;

use App\Constants\RBAC;
use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, School $school): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_SCHOOLS, RBAC::SCOPE_READ));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_SCHOOLS, RBAC::SCOPE_CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, School $school): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_SCHOOLS, RBAC::SCOPE_UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, School $school): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_SCHOOLS, RBAC::SCOPE_DELETE));
    }
}
