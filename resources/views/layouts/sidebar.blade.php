<nav class="flex-1 px-2 py-4 space-y-2">
    <!-- Dashboard Link -->
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-primary-light transition-colors duration-200">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7-7-7M19 10v10a1 1 0 01-1 1h-3"></path>
        </svg>
        <span>{{ __('Dashboard') }}</span>
    </x-nav-link>

    <!-- Browse Books Link -->
    <x-nav-link :href="route('livres.index')" :active="request()->routeIs('livres.index')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-primary-light transition-colors duration-200">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.414 9.655 5 8.35 5H6.25C5.104 5 4 6.104 4 7.25v11.5C4 19.896 5.104 21 6.25 21h11.5C18.896 21 20 19.896 20 18.75V7.25C20 6.104 18.896 5 17.75 5h-1.35C14.345 5 13.168 5.414 12 6.253zM18 10H6v8h12v-8z"></path>
        </svg>
        <span>{{ __('Browse Books') }}</span>
    </x-nav-link>

    <!-- My Loans Link -->
    <x-nav-link :href="route('emprunts.index')" :active="request()->routeIs('emprunts.index')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-primary-light transition-colors duration-200">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v2a2 2 0 01-2 2h-5m-9 0H5a2 2 0 01-2-2v-2a2 2 0 012-2h5m-9 0V9a2 2 0 012-2h2m-2 4h2m4-4h2m-4 4h2m-4 4h2"></path>
        </svg>
        <span>{{ __('My Loans') }}</span>
    </x-nav-link>

    <!-- My Reservations Link -->
    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-primary-light transition-colors duration-200">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span>{{ __('My Reservations') }}</span>
    </x-nav-link>

    @if (Auth::user()->role === 'admin')
        <!-- Admin Dashboard Link -->
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-primary-light transition-colors duration-200">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m3 0V6a2 2 0 012-2h2a2 2 0 012 2v12m0 0h3.25M17 13H7M12 4v10m6 0h2m-8-4v3"></path>
            </svg>
            <span>{{ __('Admin Dashboard') }}</span>
        </x-nav-link>
    @endif
</nav>