@extends('layouts.app')

@section('title', "Add New Category - ")

@section('header', "Add New Category")

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 2xl:p-8 dark:text-gray-100">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Create New Category</h2>

                    <form action="{{ route('tenant.categories.store') }}" method="POST" class="w-full max-w-xl " enctype="multipart/form-data">
                        @csrf

                        <div class="mt-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500 ">*</span></label>
                            
                            <div class="mt-1">
                                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500 ">*</span></label>
                            
                            <div class="mt-1">
                                <x-text-input id="title" class="block w-full mt-1" type="text" name="title" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image <span class="text-red-500 ">*</span></label>

                            <div class="mt-1">
                                <x-text-input id="image" class="block w-full mt-1" type="file" name="image" required />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>

                        <x-primary-button class="mt-6">
                            Create
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
