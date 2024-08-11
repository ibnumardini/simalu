<?php

namespace App\Constants;

class RBAC
{
    const GUARD_WEB = 'web';

    const SCOPE_CREATE = 'create';
    const SCOPE_READ = 'read';
    const SCOPE_UPDATE = 'update';
    const SCOPE_DELETE = 'delete';
    const SCOPE_MANAGEMENT = 'management';

    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    const PAGE_DASHBOARD = 'dashboard';
    const PAGE_ALUMNIS = 'alumnis';
    const PAGE_WORK_HISTORIES = 'work-histories';
    const PAGE_SCHOOLS = 'schools';
    const PAGE_COMPANIES = 'companies';
    const PAGE_PROFILE = 'profiles';
    const PAGE_SETTINGS = 'settings';
}
