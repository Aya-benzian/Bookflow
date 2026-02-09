<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-navy leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div class="space-y-8">
            <div class="bg-primary-creamy overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-text-on-creamy">
                    <h3 class="text-2xl font-semibold text-primary-navy mb-6">Your Library Overview</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    
                        <!-- Borrowed Books Card -->
                        <a href="{{ route('emprunts.index') }}" class="group block p-6 bg-primary-creamy hover:bg-neutral-grey rounded-lg shadow-md transition-all duration-300 ease-in-out border-b-4 border-accent-gold">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-primary-deep-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-text-on-creamy truncate">Borrowed Books</p>
                                    <p class="text-4xl font-bold text-primary-navy">{{ $borrowedBooksCount }}</p>
                                </div>
                            </div>
                        </a>
    
                        <!-- Reserved Books Card -->
                        <a href="{{ route('reservations.index') }}" class="group block p-6 bg-primary-creamy hover:bg-neutral-grey rounded-lg shadow-md transition-all duration-300 ease-in-out border-b-4 border-accent-gold">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-primary-deep-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-text-on-creamy truncate">Active Reservations</p>
                                    <p class="text-4xl font-bold text-primary-navy">{{ $reservedBooksCount }}</p>
                                </div>
                            </div>
                        </a>
    
                        <!-- Overdue Books Card -->
                        <a href="{{ route('emprunts.index') }}?overdue=true" class="group block p-6 bg-primary-creamy hover:bg-neutral-grey rounded-lg shadow-md transition-all duration-300 ease-in-out border-b-4 border-secondary-blue">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-secondary-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-text-on-creamy truncate">Overdue Books</p>
                                    <p class="text-4xl font-bold text-secondary-blue">{{ $overdueBooksCount }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                        <!-- Recent Borrowed Books -->
                        <div class="bg-primary-creamy p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-primary-navy mb-4">Recently Borrowed</h4>
                            @if ($recentBorrowed->isEmpty())
                                <p class="text-text-on-creamy">No recent borrowed books.</p>
                            @else
                                <ul>
                                    @foreach ($recentBorrowed as $emprunt)
                                        <li class="mb-3 pb-3 border-b border-secondary-light-gray last:border-b-0">
                                            <a href="{{ route('livres.show', $emprunt->livre) }}" class="text-secondary-blue hover:text-accent-gold font-medium">
                                                {{ $emprunt->livre->titre }}
                                            </a> by {{ $emprunt->livre->auteur }}
                                            @if ($emprunt->date_retour_prevue)
                                                <p class="text-sm text-text-on-creamy">Due: {{ $emprunt->date_retour_prevue->format('M d, Y') }}</p>
                                            @else
                                                <p class="text-sm text-text-on-creamy">Due: N/A</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-4 text-right">
                                <a href="{{ route('emprunts.index') }}" class="text-secondary-blue hover:text-accent-gold text-sm font-medium">View All Loans &rarr;</a>
                            </div>
                        </div>
    
                        <!-- Recent Reserved Books -->
                        <div class="bg-primary-creamy p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-primary-navy mb-4">Recently Reserved</h4>
                            @if ($recentReserved->isEmpty())
                                <p class="text-text-on-creamy">No recent reservations.</p>
                            @else
                                <ul>
                                    @foreach ($recentReserved as $reservation)
                                        <li class="mb-3 pb-3 border-b border-secondary-light-gray last:border-b-0">
                                            <a href="{{ route('livres.show', $reservation->livre) }}" class="text-secondary-blue hover:text-accent-gold font-medium">
                                                {{ $reservation->livre->titre }}
                                            </a> by {{ $reservation->livre->auteur }}
                                            @if ($reservation->date_reservation)
                                                <p class="text-sm text-text-on-creamy">Reserved: {{ $reservation->date_reservation->format('M d, Y') }}</p>
                                            @else
                                                <p class="text-sm text-text-on-creamy">Reserved: N/A</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-4 text-right">
                                <a href="{{ route('reservations.index') }}" class="text-secondary-blue hover:text-accent-gold text-sm font-medium">View All Reservations &rarr;</a>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-8 text-center">
                        <a href="{{ route('livres.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-text-on-navy bg-secondary-blue hover:bg-accent-gold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-blue">
                            Browse Our Book Catalog
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
