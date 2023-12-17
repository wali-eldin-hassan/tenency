<?php

namespace App\Http\Controllers\Tenants\Dashboard;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function index()
    {
        return view('tenants.dashboard.customers.index', [
            'users_count' => tenant()->users()
                ->where('email', '!=', auth()->user()->email)->count(),
            'users' => tenant()->users()
                ->where('email', '!=', auth()->user()->email)
                ->latest('id')
                ->paginate(parent::ELEMENTS_PER_PAGE),
        ]);
    }

    public function create()
    {
        return view('tenants.dashboard.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:10', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->tenants()->attach(tenant('id'), [
            'role' => 'user',
        ]);

        session()->flash('success', 'User Role Updated Successfully !');

        return back();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:owner,user'],
        ]);

        $user->tenants()->updateExistingPivot(tenant('id'), [
            'role' => $request->role,
        ]);

        session()->flash('success', 'User Role Updated Successfully !');

        return redirect()->route('tenant.customers.index');
    }
}
