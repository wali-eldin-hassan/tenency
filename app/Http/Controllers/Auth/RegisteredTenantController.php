<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tenant;
use Illuminate\View\View;
use App\Events\TenantCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterTenantRequest;

class RegisteredTenantController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterTenantRequest $request): RedirectResponse
    {
        $tenant = Tenant::create([
            'company' => $request->company,
            'domain' => $request->domain,
            'email' => $request->email,
            'approved' => true,
        ]);

        $tenant->createDomain([
            'domain' => $request->domain,
        ]);

        TenantCreated::dispatch(array_merge(['tenant_id' => $tenant->id], $request->toArray()));

        return redirect(tenant_route($tenant->domains()->first()->domain, 'tenant.login'));
    }
}
