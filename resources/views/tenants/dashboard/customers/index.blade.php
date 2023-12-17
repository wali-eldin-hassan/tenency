@extends('layouts.app')

@section('title', "Audience - ")

@section('header', "Audience ($users_count)")

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 2xl:p-8 dark:text-gray-100">
                    @empty($users->count())
                        <div class="max-w-md mx-auto">
                            <img src="/svgs/empty.svg" alt="blank-canvas-animate.svg">

                            <p class="mt-2 text-2xl font-bold text-center text-gray-600 dark:text-gray-200">No Users Added</p>
                        </div>
                    @else
                    <a href="{{ route('tenant.customers.create') }}" class="inline-flex items-center px-4 py-2 space-x-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                
                        <span>Add new Product</span>
                    </a>
                        <div class="flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                                                <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="py-4 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 w-10 h-10">
                                                                <img class="w-10 h-10 rounded-full" src="{{ $user->avatar }}" alt="">
                                                            </div>
                                                            
                                                            <div class="ml-4">
                                                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                                                <div class="text-gray-500">{{ $user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        <a href="tel:{{ $user->phone }}" class="font-medium text-blue-500 hover:underline">{{ $user->phone }}</a>
                                                    </td>
                                                    <td class="py-4 text-sm text-gray-500 whitespace-nowrap" x-data="{ editing: false }" >
                                                        <div class="px-8 font-medium text-indigo-600 capitalize" 
                                                            @click.prevent 
                                                            @dblclick="editing = true"
                                                            x-show="!editing"
                                                        >
                                                            {{ $user->pivot->role }}
                                                        </div>
                                                        
                                                        <form action="{{ route('tenant.customers.update', $user->id) }}" method="POST" x-show="editing">
                                                            @csrf
                                                            @method('patch')
                                                            <select onChange="this.form.submit()" name="role" id="role" class="text-gray-600 border-none rounded-lg appearance-none focus:border-none focus:ring-0">
                                                                <option value="owner" @selected($user->pivot->role === 'owner')>Owner</option>
                                                                <option value="user" @selected($user->pivot->role === 'user')>User</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                  
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endempty
                </div>
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

