@extends('layouts.app')

@section('title', "$product->name Product - ")

@section('header', "$product->name Product")

@section('action')
    <a href="/dashboard/products" type="button" class="inline-flex items-center w-full text-sm font-medium text-indigo-600 transition-colors duration-200 gap-x-2 hover:text-indigo-800 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>
        <span>Back to All Products</span>
    </a>
@endsection

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 md:flex md:items-center md:gap-x-8 2xl:p-8 dark:text-gray-100">
                    <div class="flex overflow-hidden bg-gray-100 rounded-lg shrink-0 md:w-64 h-80 sm:h-96">
                        <img src="{{ $product->image_path }}" alt="Sample of 30 icons with friendly and fun details in outline, filled, and brand color styles." class="object-cover h-full min-w-full">
                    </div>

                    <div class="mt-4 md:mt-0">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->name }} - <span class="text-gray-500 capitalize ">{{ $product->color }}</span></h1>

                        <p class="mt-3 text-sm text-gray-500"><span class="text-lg font-semibold text-indigo-500">{{ $product->stock }} item in Stock</span> - Added {{ $product->created_at->diffForHumans() }}</p>
                        
                        <div class="inline-flex px-2 mt-4 text-base font-semibold leading-5 text-green-700 bg-green-100 rounded-full">${{ $product->price }}</div>

                        <p class="mt-4 text-gray-500">{{ $product->description }}</p>
                        <a href="{{ route('tenant.categories.index') }}" class="inline-block mt-4 font-semibold text-gray-700 hover:underline">{{ $product->category->name }}</a>

                        <div class="flex items-center mt-6 gap-x-5">
                            <a href="{{ route('tenant.products.edit', $product->slug) }}" class="inline-flex items-center text-indigo-600 gap-x-1 hover:text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>

                                <span>Edit</span>
                            </a>

                            <form class="inline-flex" method="POST" action="{{ route('tenant.products.destroy', $product->slug) }}">
                                @csrf
                                @method('delete')
                                
                                <button class="inline-flex items-center text-red-600 gap-x-1 hover:text-red-800 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>

                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

