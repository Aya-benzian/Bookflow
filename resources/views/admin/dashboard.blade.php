<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">At a Glance</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">

                        <!-- Total Users Card -->
                        <a href="{{ route('admin.users.index') }}" class="group block p-6 bg-white hover:bg-gray-50 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.274-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.125-1.274.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">Total Users</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $usersCount }}</p>
                                </div>
                            </div>
                        </a>

                        <!-- Total Books Card -->
                        <a href="{{ route('admin.livres.index') }}" class="group block p-6 bg-white hover:bg-gray-50 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-5.747-8.994l-2.006 2.006a2.25 2.25 0 000 3.182l2.006 2.006m11.494-11.494l-2.006-2.006a2.25 2.25 0 00-3.182 0l-2.006 2.006m11.494 2.006l2.006-2.006a2.25 2.25 0 000-3.182l-2.006-2.006M12 6.253l5.747-5.747m-11.494 11.494l5.747 5.747" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">Total Books</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $livresCount }}</p>
                                </div>
                            </div>
                        </a>

                        <!-- Borrowed Books Card -->
                        <a href="{{ route('admin.emprunts.index') }}" class="group block p-6 bg-white hover:bg-gray-50 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">Borrowed Books</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $empruntsCount }}</p>
                                </div>
                            </div>
                        </a>

                        <!-- Overdue Books Card -->
                        <a href="{{ route('admin.emprunts.index') }}" class="group block p-6 bg-white hover:bg-gray-50 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">Overdue Books</p>
                                    <p class="text-3xl font-bold text-red-600">{{ $overdueEmpruntsCount }}</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Active Reservations Card -->
                        <a href="{{ route('admin.reservations.index') }}" class="group block p-6 bg-white hover:bg-gray-50 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">Active Reservations</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $reservationsCount }}</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
