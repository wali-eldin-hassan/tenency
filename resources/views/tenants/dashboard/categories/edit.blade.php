@extends('layouts.app')

@section('title', "Edit $category->name Category - ")

@section('header', "Edit $category->name Category")

@section('action')
    <a href="{{ route('tenant.categories.index') }}" type="button" class="inline-flex items-center w-full text-sm font-medium text-indigo-600 transition-colors duration-200 gap-x-2 hover:text-indigo-800 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>
        <span>Back to Categories</span>
    </a>
@endsection

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 2xl:p-8 dark:text-gray-100">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Edit {{ $category->name }} Category</h2>

                    <form action="{{ route('tenant.categories.update', $category->slug) }}" method="POST" class="w-full max-w-xl " enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="mt-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500 ">*</span></label>
                            
                            <div class="mt-1">
                                <x-text-input value="{{ $category->name }}" id="name" class="block w-full mt-1" type="text" name="name" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500 ">*</span></label>
                            
                            <div class="mt-1">
                                <x-text-input value="{{ $category->title }}" id="title" class="block w-full mt-1" type="text" name="title" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            
                            <div class="mt-1">
                                <x-text-input id="image" class="block w-full mt-1 focus:outline-none" type="file" name="image" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>

                        <x-primary-button class="mt-6">
                            Edit
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
