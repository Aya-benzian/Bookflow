<nav x-data="{ open: false }" class="bg-primary-creamy shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24 pt-2">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <x-application-logo class="h-9 w-auto fill-current text-text-on-creamy" />
                        <span class="text-3xl font-extrabold text-accent-gold hover:text-secondary-blue">BookFlow</span>
                    </a>
                </div>
            </div>

            <!-- Centered Navigation Links -->
            <div class="flex-grow flex items-center justify-center">
                <div class="flex items-center space-x-20">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.137-.439 1.577 0L21.75 12m-4.5 9a2.25 2.25 0 002.25-2.25V15h-9v2.25c0 .621.504 1.125 1.125 1.125h.944c.505 0 .937-.282 1.189-.684l1.192-1.996c.159-.265.416-.424.704-.424h.981c.288 0 .545.159.704.424l1.192 1.996c.252.402.684.684 1.189.684h.944c.621 0 1.125-.504 1.125-1.125zm-9.75-9.375c.679 0 1.229-.537 1.229-1.2s-.55-1.2-1.229-1.2-.55 1.2-1.229 1.2 1.229 1.2 1.229 1.2z"/></svg>
                        </x-slot>
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('livres.index')" :active="request()->routeIs('livres.*')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.414 9.659 5 8.322 5H5c-1.105 0-2 .894-2 2v10c0 1.105.895 2 2 2h4.678c1.337 0 2.51-.414 3.678-1.253m0 0l4-4m4 4v-4m0 0h-4"/></svg>
                        </x-slot>
                        {{ __('Books') }}
                    </x-nav-link>
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </x-slot>
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('emprunts.index')" :active="request()->routeIs('emprunts.*')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5l.45 4.5M10.75 7.5l-.45 4.5M19.5 3h-15a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 004.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3z"/></svg>
                        </x-slot>
                        {{ __('Loans') }}
                    </x-nav-link>
                    @unless(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.*')">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25h.375M16.5 7.5H12H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18A2.25 2.25 0 0016.5 15V7.5z" /></svg>
                            </x-slot>
                            {{ __('Reservations') }}
                        </x-nav-link>
                    @endunless
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25h.375M16.5 7.5H12H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18A2.25 2.25 0 0016.5 15V7.5z" /></svg>
                            </x-slot>
                            {{ __('Reservations') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15M4.5 16.06c.433-.12 1.05-.12 1.05-.12a2.25 2.25 0 013.75 1.5v3M15 15h3.75M4.5 19.5h15M4.5 16.06c.433-.12 1.05-.12 1.05-.12a2.25 2.25 0 013.75 1.5v3M4.5 19.5c0 .828.672 1.5 1.5 1.5h12c.828 0 1.5-.672 1.5-1.5V6a.75.75 0 00-.75-.75H5.25A.75.75 0 004.5 6v13.5zm7.5-9a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </x-slot>
                        {{ __('Profile') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-text-on-creamy bg-primary-creamy hover:text-secondary-blue focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-text-on-creamy hover:text-secondary-blue hover:bg-neutral-grey focus:outline-none focus:bg-neutral-grey focus:text-secondary-blue transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('livres.index')" :active="request()->routeIs('livres.*')">
                {{ __('Books') }}
            </x-responsive-nav-link>
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('emprunts.index')" :active="request()->routeIs('emprunts.*')">
                {{ __('Loans') }}
            </x-responsive-nav-link>
            @unless(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.*')">
                    {{ __('Reservations') }}
                </x-responsive-nav-link>
            @endunless
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                    {{ __('Reservations') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-neutral-grey">
                            <div class="px-4">
                                <div class="font-medium text-base text-text-on-creamy">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-secondary-blue">{{ Auth::user()->email }}</div>
                            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>