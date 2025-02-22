<?php
namespace App\Policies;

use App\Constants\RBAC;
use App\Models\User;
use App\Models\WorkHistory;

class WorkHistoryPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool | null
    {
        return $this->viewAny($user) ?: null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_MANAGEMENT));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WorkHistory $workHistory): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_READ)) && $workHistory->alumni->user->is($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WorkHistory $workHistory): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_UPDATE)) && $workHistory->alumni->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorkHistory $workHistory): bool
    {
        return $user->can(sprintf("%s/%s", RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_DELETE)) && $workHistory->alumni->user->is($user);
    }
}
