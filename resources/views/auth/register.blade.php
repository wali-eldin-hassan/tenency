@extends('layouts.guest')

@section('title', 'Register - ')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- company -->
        <div>
            <x-input-label for="company" :value="__('Company')" />
            <x-text-input id="company" class="block w-full mt-1" type="text" name="company" :value="old('company')" required autofocus />
            <x-input-error :messages="$errors->get('company')" class="mt-2" />
        </div>

        <!-- domain -->
        <div class="mt-4">
            <x-input-label for="domain" :value="__('Domain')" />
            <div class="flex items-center mt-1 gap-x-2">
                <x-text-input id="domain" class="block w-full" type="text" name="domain" :value="old('domain')" required />
                <span>{{ config('tenancy.central_domains')[0] }}</span>
            </div>
            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
        </div>

        <!-- Name -->
        <div  class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
@endsection
