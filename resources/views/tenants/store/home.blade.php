@extends('layouts.store')

@section('title', 'Home - ')

@section('content')
    <header class="relative overflow-hidden">
        <!-- Hero section -->
        <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
            <div class="relative px-4 mx-auto max-w-7xl sm:static sm:px-6 lg:px-8">
                <div class="sm:max-w-lg">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 font sm:text-6xl">Summer styles are finally here</h1>
                <p class="mt-4 text-xl text-gray-500">This year, our new summer collection will shelter you from the harsh elements of a world that doesn't care if you live or die.</p>
                </div>
                <div>
                <div class="mt-6">
                    <!-- Decorative image grid -->
                    <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                        <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                            <div class="flex items-center space-x-6 lg:space-x-8">
                            <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                <div class="h-64 overflow-hidden rounded-lg w-44 sm:opacity-0 lg:opacity-100">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                            </div>
                            <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                            </div>
                            <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                                <div class="h-64 overflow-hidden rounded-lg w-44">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg" alt="" class="object-cover object-center w-full h-full">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <a href="/store" class="inline-block py-2 font-medium text-center text-white bg-indigo-600 border border-transparent rounded-md px-7 hover:bg-indigo-700">Shop Now</a>
                </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="bg-gray-100">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-2xl py-16 mx-auto sm:py-24 lg:max-w-none lg:py-32">
                <h2 class="text-2xl font-bold text-gray-900">Our Collections</h2>

                <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
                    @foreach ($categories as $category)
                        <div class="relative group">
                            <div class="relative w-full overflow-hidden bg-white rounded-lg h-80 group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                                <img src="{{ $category->image_path }}" alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." class="object-cover object-center w-full h-full">
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a href="{{ $category->path() }}">
                                <span class="absolute inset-0"></span>
                                {{ $category->name }}
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-gray-900">{{ $category->title }}</p>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>

        <div class="bg-white">
        <div class="max-w-2xl px-4 py-16 mx-auto sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>

            <div class="grid grid-cols-1 mt-6 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $product)
                    @include('components.product-card')
                @endforeach
            </div>
        </div>
        </div>

        <section aria-labelledby="sale-heading">
            <div class="pt-32 overflow-hidden sm:pt-14">
                <div class="bg-gray-800">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative pt-48 pb-16 sm:pb-24">
                    <div>
                        <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-white md:text-5xl">
                        Final Stock.
                        <br>
                        Up to 50% off.
                        </h2>
                        <div class="mt-6 text-base">
                        <a href="/store" class="font-semibold text-white">
                            Shop the sale
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                        </div>
                    </div>

                    <div class="absolute transform -translate-x-1/2 -top-32 left-1/2 sm:top-6 sm:translate-x-0">
                        <div class="flex ml-24 space-x-6 min-w-max sm:ml-3 lg:space-x-8">
                        <div class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                            <div class="flex-shrink-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg" alt="">
                            </div>

                            <div class="flex-shrink-0 mt-6 sm:mt-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg" alt="">
                            </div>
                        </div>
                        <div class="flex space-x-6 sm:-mt-20 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                            <div class="flex-shrink-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-01.jpg" alt="">
                            </div>

                            <div class="flex-shrink-0 mt-6 sm:mt-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-02.jpg" alt="">
                            </div>
                        </div>
                        <div class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                            <div class="flex-shrink-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg" alt="">
                            </div>

                            <div class="flex-shrink-0 mt-6 sm:mt-0">
                            <img class="object-cover w-64 h-64 rounded-lg md:h-72 md:w-72" src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg" alt="">
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </main>
@endsection
