@extends('layouts.store')

@section('title', 'Home - ')

@section('content')
    <div class="bg-white">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:pb-24">
            <x-alert></x-alert>
            
            <div class="max-w-xl">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and download invoices.</p>
            </div>

            <div class="mt-16">
                <h2 class="sr-only">Recent orders</h2>

                <div class="space-y-20">
                    @foreach ($orders as $order)
                        <div>
                            <div class="px-4 py-6 rounded-lg bg-gray-50 sm:px-6">
                                <dl class="flex-auto space-y-6 text-sm text-gray-600 divide-y divide-gray-200 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                    <div class="flex justify-between sm:block">
                                        <dt class="font-medium text-gray-900">Date placed</dt>
                                        <dd class="sm:mt-1">
                                        <time datetime="2021-01-22">{{ $order->created_at->diffForHumans() }}</time>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                        <dt class="font-medium text-gray-900">Order number</dt>
                                        <dd class="sm:mt-1">{{ $order->hash }}</dd>
                                    </div>
                                    <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                        <dt>Total amount</dt>
                                        <dd class="sm:mt-1">${{ $order->total }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <table class="w-full mt-4 text-gray-500 sm:mt-6">
                                <thead class="text-sm text-left text-gray-500 sr-only sm:not-sr-only">
                                    <tr>
                                        <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">Product</th>
                                        <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">Price</th>
                                        <th scope="col" class="hidden py-3 pr-8 font-normal sm:table-cell">Status</th>
                                        <th scope="col" class="w-0 py-3 font-normal text-right">Info</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="text-sm border-b border-gray-200 divide-y divide-gray-200 sm:border-t">
                                    @foreach (json_decode($order->order_details) as $item)
                                        <tr>
                                            <td class="py-6 pr-8">
                                                <div class="flex items-center">
                                                    <img src="{{ $item->attributes->image }}" alt="Detail of mechanical pencil tip with machined black steel shaft and chrome lead tip." class="object-cover object-center w-16 h-16 mr-6 rounded">
                                                    <div>
                                                    <div class="font-medium text-gray-900">{{ $item->name }} <span class="font-normal text-gray-600">x {{ $item->quantity }}</span></div>
                                                    <div class="mt-1 sm:hidden">${{ $item->price * $item->quantity }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="hidden py-6 pr-8 sm:table-cell">${{ $item->price * $item->quantity }}</td>

                                            <td class="hidden py-6 pr-8 sm:table-cell">Delivered Jan 25, 2021</td>

                                            <td class="py-6 font-medium text-right whitespace-nowrap">
                                                <a href="{{ $item->attributes->path }}" class="text-indigo-600">View<span class="hidden lg:inline"> Product</span><span class="sr-only">, Machined Pen and Pencil Set</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach

                    @empty($orders->count())
                        <div class="max-w-md mx-auto">
                            <img src="/empty.svg" alt="blank-canvas-animate.svg">

                            <p class="mt-2 text-2xl font-bold text-center text-gray-600 dark:text-gray-200">No item Added</p>
                        </div>
                    @endempty
                </div>
            </div>

            <div class="mt-10">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
