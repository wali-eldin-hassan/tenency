<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTenantOwner
{
    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $user = User::create([
            'name' => $event->data['name'],
            'phone' => $event->data['phone'],
            'email' => $event->data['email'],
            'password' => Hash::make($event->data['password']),
        ]);

        $user->tenants()->attach($event->data['tenant_id'], [
            'role' => 'owner',
        ]);
    }
}
