@extends('layouts.store')

@section('title', 'Checkout - ')

@section('content')
    <div class="bg-white">
        <div class="max-w-2xl px-4 pt-16 pb-24 mx-auto sm:px-6 lg:max-w-7xl lg:px-8">
            <x-alert></x-alert>
            
            <h2 class="sr-only">Checkout</h2>

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                <form action="{{ route('tenant.orders.store') }}" method="POST">
                    @csrf
                    <div class="max-w-2xl px-4 mx-auto lg:max-w-none lg:px-0">
                        <div>
                            <h3 id="contact-info-heading" class="text-lg font-medium text-gray-900">Contact information</h3>

                            <div class="mt-6">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                
                                <x-text-input id="email" class="block w-full mt-1 cursor-not-allowed bg-gray-50" disabled type="email" name="email" value="{{ auth()->user()->email }}" required />
                                <x-text-input id="email" class="hidden" type="email" name="email" value="{{ auth()->user()->email }}" required />
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-medium text-gray-900">Payment details</h3>

                            <div class="grid grid-cols-3 mt-6 gap-y-6 gap-x-4 sm:grid-cols-4">
                                <div class="col-span-3 sm:col-span-4">
                                    <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    
                                    <div class="mt-1">
                                        <x-text-input id="card_number" class="block w-full mt-1" type="text" name="card_number" required autofocus />
                                    </div>
                                </div>

                                <div class="col-span-2 sm:col-span-3">
                                    <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                                    
                                    <div class="mt-1">
                                        <x-text-input id="expiration_date" class="block w-full mt-1" type="text" name="expiration_date" required autofocus />
                                    </div>
                                </div>

                                <div>
                                    <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                    
                                    <div class="mt-1">
                                        <x-text-input id="cvc" class="block w-full mt-1" type="text" name="cvc" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-medium text-gray-900">Shipping address</h3>

                            <div class="grid grid-cols-1 mt-6 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>

                                    <div class="mt-1">
                                        <x-text-input id="address" class="block w-full mt-1" type="text" name="address" required />
                                    </div>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>

                                    <div class="mt-1">
                                        <x-text-input id="city" class="block w-full mt-1" type="text" name="city" required />
                                    </div>
                                </div>

                                <div>
                                    <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>

                                    <div class="mt-1">
                                        <x-text-input id="region" class="block w-full mt-1" type="text" name="region" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-medium text-gray-900">Billing information</h3>

                            <div class="flex items-center mt-6">
                                <input id="same-as-shipping" name="same-as-shipping" type="checkbox" checked class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                
                                <div class="ml-2">
                                    <label for="same-as-shipping" class="text-sm font-medium text-gray-900">Same as shipping information</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 mt-10 border-t border-gray-200">
                            <button type="submit" class="w-full px-4 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Confirm order</button>
                        </div>
                    </div>
                </form>

                <!-- Order summary -->
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                    <div class="mt-4 bg-white border border-gray-100 rounded-lg">
                        <h3 class="sr-only">Items in your cart</h3>
                        
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <li class="flex px-4 py-6 sm:px-6">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->attributes->image }}" alt="Front of men&#039;s Basic Tee in black." class="w-20 rounded-md">
                                    </div>

                                    <div class="flex flex-col flex-1 ml-6">
                                        <div class="flex">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm">
                                                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ $item->name }}</a>
                                                </h4>
                                                
                                                <p class="mt-1 text-sm text-gray-500">{{ $item->attributes->color }}</p>
                                            </div>

                                            <div class="flex-shrink-0 flow-root ml-4">
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

                                        <div class="flex items-end justify-between flex-1 pt-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">${{ $item->price }}</p>

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
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <dl class="px-4 py-6 space-y-6 border-t border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                            <dt class="text-sm">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ Cart::getTotal() }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                            <dt class="text-sm">Shipping</dt>
                            <dd class="text-sm font-medium text-gray-900">Free</dd>
                            </div>
                            <div class="flex items-center justify-between">
                            <dt class="text-sm">Taxes</dt>
                            <dd class="text-sm font-medium text-gray-900">$18.32</dd>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <dt class="text-base font-medium">Total</dt>
                            <dd class="text-base font-medium text-gray-900">${{ Cart::getTotal() + 18.32 }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection