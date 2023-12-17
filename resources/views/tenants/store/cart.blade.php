@extends('layouts.store')

@section('title', 'Cart - ')

@section('content')
    <div class="bg-white">
        <div class="max-w-2xl px-4 pt-16 pb-24 mx-auto sm:px-6 lg:max-w-7xl lg:px-8">
            <x-alert></x-alert>

            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>
            
            <div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    @if(count(Cart::getContent()) !== 0)
                        <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <li class="flex py-6 sm:py-10">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->attributes->image }}" alt="Front of men&#039;s Basic Tee in sienna." class="object-cover object-center w-24 h-24 rounded-md sm:h-48 sm:w-48">
                                    </div>
    
                                    <div class="flex flex-col justify-between flex-1 ml-4 sm:ml-6">
                                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ $item->name }}</a>
                                                    </h3>
                                                </div>
    
                                                <div class="flex mt-1 text-sm">
                                                    <p class="text-gray-500">{{ $item->attributes->color }}</p>
                                                </div>
    
                                                <p class="mt-1 text-sm font-medium text-gray-900">${{ $item->price }}</p>
                                            </div>
    
                                            <div class="mt-4 sm:mt-0 sm:pr-9">
                                                <form action="{{ route('tenant.cart.update') }}" method="POST" x-data="{ quantity: {{ $item->quantity }} }">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id}}" >
                                                    
                                                    <label for="quantity-0" class="sr-only">Quantity, Basic Tee</label>
        
                                                    <select x-model="quantity" name="quantity" class="max-w-full rounded-md border border-gray-200 py-1.5 text-left text-base font-medium leading-5 text-gray-700 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>

                                                    <button class="ml-2 text-indigo-500 focus:outline-none">Edit</button>
                                                </form>
    
                                                <div class="absolute top-0 right-0">
                                                    <form action="{{ route('tenant.cart.destroy') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
    
                                                        <button class="inline-flex p-2 -m-2 text-gray-400 hover:text-gray-500">
                                                            <span class="sr-only">Remove</span>
                                                            <!-- Heroicon name: mini/x-mark -->
                                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
    
                                        <p class="flex mt-4 space-x-2 text-sm text-gray-700">
                                            <!-- Heroicon name: mini/check -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                            <span>In stock</span>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="py-6">
                            <form action="{{ route('tenant.cart.clear') }}" method="POST">
                                @csrf
                                <x-danger-button class="px-6 py-2 font-semibold text-red-700 bg-red-100 hover:bg-red-200">Clear The Cart</x-danger-button>
                            </form>
                        </div>
                    @else
                        <div class="max-w-md mx-auto">
                            <img src="/empty.svg" alt="blank-canvas-animate.svg">

                            <p class="mt-2 text-2xl font-bold text-center text-gray-600 dark:text-gray-200">No item Added</p>
                        </div>
                    @endif
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="px-4 py-6 mt-16 rounded-lg bg-gray-50 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">${{ Cart::getTotal() }}</dd>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <dt class="flex text-sm text-gray-600">
                            <span>Tax estimate</span>
                            <a href="#" class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Learn more about how tax is calculated</span>
                                <!-- Heroicon name: mini/question-mark-circle -->
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">$18.32</dd>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">${{ Cart::getTotal() + 18.32 }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="/checkout" class="block w-full px-4 py-3 text-base font-medium text-center text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Checkout</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
