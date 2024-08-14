<?php

use App\Constants\RBAC;

$user = [
    ['page' => RBAC::PAGE_DASHBOARD, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_PROFILE, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_PROFILE, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_ALUMNIS, 'scope' => RBAC::SCOPE_CREATE],
    ['page' => RBAC::PAGE_ALUMNIS, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_ALUMNIS, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_ALUMNIS, 'scope' => RBAC::SCOPE_DELETE],
    ['page' => RBAC::PAGE_WORK_HISTORIES, 'scope' => RBAC::SCOPE_CREATE],
    ['page' => RBAC::PAGE_WORK_HISTORIES, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_WORK_HISTORIES, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_WORK_HISTORIES, 'scope' => RBAC::SCOPE_DELETE],
];

$admin = [
    ['page' => RBAC::PAGE_ALUMNIS, 'scope' => RBAC::SCOPE_MANAGEMENT],
    ['page' => RBAC::PAGE_WORK_HISTORIES, 'scope' => RBAC::SCOPE_MANAGEMENT],
    ['page' => RBAC::PAGE_PROFILE, 'scope' => RBAC::SCOPE_MANAGEMENT],
    ['page' => RBAC::PAGE_SCHOOLS, 'scope' => RBAC::SCOPE_CREATE],
    ['page' => RBAC::PAGE_SCHOOLS, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_SCHOOLS, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_SCHOOLS, 'scope' => RBAC::SCOPE_DELETE],
    ['page' => RBAC::PAGE_COMPANIES, 'scope' => RBAC::SCOPE_CREATE],
    ['page' => RBAC::PAGE_COMPANIES, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_COMPANIES, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_COMPANIES, 'scope' => RBAC::SCOPE_DELETE],
];

$superadmin = [
    ['page' => RBAC::PAGE_ROLES, 'scope' => RBAC::SCOPE_CREATE],
    ['page' => RBAC::PAGE_ROLES, 'scope' => RBAC::SCOPE_READ],
    ['page' => RBAC::PAGE_ROLES, 'scope' => RBAC::SCOPE_UPDATE],
    ['page' => RBAC::PAGE_ROLES, 'scope' => RBAC::SCOPE_DELETE],
];

return [
    RBAC::ROLE_USER => $user,
    RBAC::ROLE_ADMIN => array_merge($user, $admin),
    RBAC::ROLE_SUPERADMIN => array_merge($user, $admin, $superadmin),
];
