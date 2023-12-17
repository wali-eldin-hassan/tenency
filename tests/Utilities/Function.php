<?php

function addUserToTenant($user, $role = 'user')
{
    $user->tenants()->attach(tenant('id'), [
        'role' => $role,
    ]);
}

function tenantRoute($route, $parameter = [])
{
    return tenant_route(tenant('domain'), $route, $parameter);
}
