<?php

use App\Constants\RBAC;

return [
    'dashboard/read'            => sprintf('%s/%s', RBAC::PAGE_DASHBOARD, RBAC::SCOPE_READ),
    'profiles/read'             => sprintf('%s/%s', RBAC::PAGE_PROFILE, RBAC::SCOPE_READ),
    'profiles/update'           => sprintf('%s/%s', RBAC::PAGE_PROFILE, RBAC::SCOPE_UPDATE),
    'profiles/management'       => sprintf('%s/%s', RBAC::PAGE_PROFILE, RBAC::SCOPE_MANAGEMENT),
    'alumnis/create'            => sprintf('%s/%s', RBAC::PAGE_ALUMNIS, RBAC::SCOPE_CREATE),
    'alumnis/read'              => sprintf('%s/%s', RBAC::PAGE_ALUMNIS, RBAC::SCOPE_READ),
    'alumnis/update'            => sprintf('%s/%s', RBAC::PAGE_ALUMNIS, RBAC::SCOPE_UPDATE),
    'alumnis/delete'            => sprintf('%s/%s', RBAC::PAGE_ALUMNIS, RBAC::SCOPE_DELETE),
    'alumnis/management'        => sprintf('%s/%s', RBAC::PAGE_ALUMNIS, RBAC::SCOPE_MANAGEMENT),
    'work-histories/create'     => sprintf('%s/%s', RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_CREATE),
    'work-histories/read'       => sprintf('%s/%s', RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_READ),
    'work-histories/update'     => sprintf('%s/%s', RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_UPDATE),
    'work-histories/delete'     => sprintf('%s/%s', RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_DELETE),
    'work-histories/management' => sprintf('%s/%s', RBAC::PAGE_WORK_HISTORIES, RBAC::SCOPE_MANAGEMENT),
    'schools/create'            => sprintf('%s/%s', RBAC::PAGE_SCHOOLS, RBAC::SCOPE_CREATE),
    'schools/read'              => sprintf('%s/%s', RBAC::PAGE_SCHOOLS, RBAC::SCOPE_READ),
    'schools/update'            => sprintf('%s/%s', RBAC::PAGE_SCHOOLS, RBAC::SCOPE_UPDATE),
    'schools/delete'            => sprintf('%s/%s', RBAC::PAGE_SCHOOLS, RBAC::SCOPE_DELETE),
    'companies/create'          => sprintf('%s/%s', RBAC::PAGE_COMPANIES, RBAC::SCOPE_CREATE),
    'companies/read'            => sprintf('%s/%s', RBAC::PAGE_COMPANIES, RBAC::SCOPE_READ),
    'companies/update'          => sprintf('%s/%s', RBAC::PAGE_COMPANIES, RBAC::SCOPE_UPDATE),
    'companies/delete'          => sprintf('%s/%s', RBAC::PAGE_COMPANIES, RBAC::SCOPE_DELETE),
    'roles/create'              => sprintf('%s/%s', RBAC::PAGE_ROLES, RBAC::SCOPE_CREATE),
    'roles/read'                => sprintf('%s/%s', RBAC::PAGE_ROLES, RBAC::SCOPE_READ),
    'roles/update'              => sprintf('%s/%s', RBAC::PAGE_ROLES, RBAC::SCOPE_UPDATE),
    'roles/delete'              => sprintf('%s/%s', RBAC::PAGE_ROLES, RBAC::SCOPE_DELETE),
];
