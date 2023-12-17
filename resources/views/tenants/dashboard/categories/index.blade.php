@extends('layouts.app')

@section('title', "Categories - ")

@section('header', "Categories ($categories_count)")

@section('action')
    <a href="{{ route('tenant.categories.create') }}" class="inline-flex items-center px-4 py-2 space-x-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
        </svg>

        <span>Add new Product</span>
    </a>
@endsection

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 2xl:p-8 dark:text-gray-100">
                    @empty($categories->count())
                        <div class="max-w-md mx-auto">
                            <img src="/svgs/empty.svg" alt="blank-canvas-animate.svg">

                            <p class="mt-2 text-2xl font-bold text-center text-gray-600 dark:text-gray-200">No Product Added</p>
                        </div>
                    @else
                        <div class="space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
                            @foreach ($categories as $category)
                                <div>
                                    <div class="relative group">
                                        <div class="relative w-full overflow-hidden transition-opacity duration-200 bg-white rounded-lg h-80 group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-80 lg:aspect-w-1 lg:aspect-h-1">
                                            <img src="{{ $category->image_path }}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="object-cover object-center w-full h-full">
                                        </div>
    
                                        <h3 class="mt-6 text-sm text-gray-500">
                                            <a href="/store/{{ $category->slug }}">
                                                <span class="absolute inset-0"></span>
                                                {{ $category->name }}
                                            </a>
                                        </h3>
                                        <p class="text-base font-semibold text-gray-900">{{ $category->title }}</p>
                                    </div>

                                    <div class="flex items-center mt-2 gap-x-3">
                                        <a href="{{ route('tenant.categories.edit', $category->slug) }}" class="inline-flex items-center text-indigo-600 gap-x-1 hover:text-indigo-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>

                                            <span>Edit</span>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('tenant.categories.destroy', $category->slug) }}">
                                            @csrf
                                            @method('delete')
                                            
                                            <button class="inline-flex items-center text-red-600 gap-x-1 hover:text-red-800 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>

                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endempty
                </div>
            </div>

            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

