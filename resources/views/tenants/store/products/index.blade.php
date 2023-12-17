@extends('layouts.store')

@section('title', 'Home - ')

@section('content')
    <main>
        <div class="bg-white">
            <div class="max-w-2xl px-4 py-16 mx-auto sm:py-12 sm:px-6 lg:max-w-7xl lg:px-8">
                <x-alert></x-alert>
                
                <div>
                    @if (isset($category))
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 capitalize">{{ $category->name }} Products - <span class="text-indigo-500 ">Wind</span> Store</h1>
                    @else
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">All Products - <span class="text-indigo-500 ">Wind</span> Store</h1>
                    @endif
                    <p class="max-w-3xl mt-4 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui obcaecati animi excepturi rerum doloremque harum eius.</p>
                </div>

                <div class="py-12 -mx-4">
                    @include('components.category-tabs')
                </div>

                @empty($products->count())
                    <div class="max-w-md mx-auto">
                        <img src="/empty.svg" alt="blank-canvas-animate.svg">

                        <p class="mt-2 text-2xl font-bold text-center text-gray-600 dark:text-gray-200">No item Added</p>
                    </div>
                @endempty

                <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($products as $product)
                        @include('components.product-card')
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
