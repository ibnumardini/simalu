<?php

namespace App\Policies;

use App\Constants\RBAC;
use App\Models\Alumni;
use App\Models\User;

class AlumniPolicy
{

    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool | null
    {
        if ($this->viewAny($user)) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ALUMNIS, RBAC::SCOPE_MANAGEMENT));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Alumni $alumni): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ALUMNIS, RBAC::SCOPE_READ)) && $alumni->user->is($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ALUMNIS, RBAC::SCOPE_CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Alumni $alumni): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ALUMNIS, RBAC::SCOPE_UPDATE)) && $alumni->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Alumni $alumni): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_ALUMNIS, RBAC::SCOPE_DELETE)) && $alumni->user()->is($user);
    }
}
