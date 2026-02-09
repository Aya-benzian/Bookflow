<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-deep-navy leading-tight">
            {{ __('Book Catalog') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-primary-warm-cream overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-6">
                <form action="{{ route('livres.index') }}" method="GET" class="flex items-center space-x-2">
                    <div class="relative flex-grow">
                        <input type="text" name="search" placeholder="Search by title or author..."
                               class="w-full pl-10 pr-4 py-2 border-secondary-light-gray focus:border-primary-rich-burgundy focus:ring-primary-rich-burgundy rounded-md shadow-sm bg-primary-warm-cream text-secondary-charcoal-gray placeholder-secondary-charcoal-gray/70 transition ease-in-out duration-150"
                               value="{{ request('search') }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-secondary-charcoal-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-deep-navy border border-transparent rounded-md font-semibold text-xs text-primary-warm-cream uppercase tracking-widest hover:bg-primary-rich-burgundy focus:bg-primary-rich-burgundy active:bg-primary-deep-navy focus:outline-none focus:ring-2 focus:ring-primary-deep-navy focus:ring-offset-2 transition ease-in-out duration-150">
                        Search
                    </button>
                    @if (request('search'))
                        <a href="{{ route('livres.index') }}" class="inline-flex items-center px-4 py-2 bg-secondary-light-gray border border-transparent rounded-md font-semibold text-xs text-secondary-charcoal-gray uppercase tracking-widest hover:bg-secondary-light-gray/70 focus:bg-secondary-light-gray active:bg-secondary-light-gray focus:outline-none focus:ring-2 focus:ring-secondary-light-gray focus:ring-offset-2 transition ease-in-out duration-150">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="mt-6">
                <a href="{{ route('admin.livres.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-primary-deep-navy uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Add New Book') }}
                </a>
            </div>
            @endif

            <h3 class="text-lg font-medium text-primary-deep-navy mb-4">All Books</h3>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($livres as $livre)
                                        <div class="bg-primary-warm-cream border border-gray-200 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 flex flex-col p-6">
                                            <div class="relative mb-4">
                                                {{-- Placeholder for Book Cover Image --}}
                                                {{-- In a real app, you would display $livre->cover_image --}}
                                                <div class="w-full h-48 bg-gradient-to-br from-secondary-blue to-accent-gold rounded-lg flex items-center justify-center text-primary-warm-cream text-lg font-semibold mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-primary-warm-cream">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.414 9.659 5 8.322 5H5c-1.105 0-2 .894-2 2v10c0 1.105.895 2 2 2h4.678c1.337 0 2.51-.414 3.678-1.253m0 0l4-4m4 4v-4m0 0h-4" />
                                                    </svg>
                                                </div>
                                                {{-- Status Badge --}}
                                                @php
                                                    $statusColor = [
                                                        'disponible' => 'bg-success-sage',
                                                        'emprunté' => 'bg-primary-deep-navy',
                                                        'reservé' => 'bg-primary-rich-burgundy',
                                                    ][$livre->statut] ?? 'bg-secondary-light-gray';
                                                    $statusTextColor = [
                                                        'disponible' => 'text-primary-deep-navy',
                                                        'emprunté' => 'text-primary-warm-cream',
                                                        'reservé' => 'text-primary-warm-cream',
                                                    ][$livre->statut] ?? 'text-secondary-charcoal-gray';
                                                @endphp
                                                <span class="absolute top-2 right-2 px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }} {{ $statusTextColor }} shadow-sm">
                                                    {{ ucfirst($livre->statut) }}
                                                </span>
                                            </div>
                                            <h4 class="text-2xl font-extrabold text-primary-deep-navy mb-2 hover:text-accent-gold transition-colors duration-200">{{ $livre->titre }}</h4>
                                            <p class="text-gray-700 font-serif mb-1"><strong>Author:</strong> {{ $livre->auteur }}</p>
                                            <p class="text-secondary-blue text-sm mb-3"><strong>Genre:</strong> {{ $livre->genre }}</p>
                                            <p class="text-gray-800 text-base mt-2 flex-grow">{{ Str::limit($livre->description, 120) }}</p>
                                            <div class="mt-5 flex flex-wrap gap-3 justify-end items-center">
                            <a href="{{ route('livres.show', $livre) }}" class="inline-flex items-center px-4 py-2 bg-secondary-blue border border-transparent rounded-md font-semibold text-xs text-primary-deep-navy uppercase tracking-widest hover:bg-primary-deep-navy focus:bg-primary-deep-navy active:bg-secondary-blue focus:outline-none focus:ring-2 focus:ring-secondary-blue focus:ring-offset-2 transition ease-in-out duration-150">
                                View Details
                            </a>

                            @if ($livre->statut === 'disponible')
                                <form method="POST" action="{{ route('emprunts.store') }}">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-success-sage border border-transparent rounded-md font-semibold text-xs text-primary-deep-navy uppercase tracking-widest hover:bg-success-sage/80 focus:bg-success-sage active:bg-success-sage focus:outline-none focus:ring-2 focus:ring-success-sage focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                        Borrow
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('reservations.store') }}">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-rich-burgundy border border-transparent rounded-md font-semibold text-xs text-primary-warm-cream uppercase tracking-widest hover:bg-secondary-warm-gold focus:bg-secondary-warm-gold active:bg-primary-rich-burgundy focus:outline-none focus:ring-2 focus:ring-secondary-warm-gold focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                        Reserve
                                    </button>
                                </form>
                            @elseif ($livre->statut === 'reservé')
                                {{-- Check if reserved by current user to allow borrowing --}}
                                @php
                                    $userReservation = $livre->reservations->firstWhere('user_id', Auth::id());
                                @endphp
                                @if ($userReservation)
                                    <form method="POST" action="{{ route('emprunts.store') }}">
                                        @csrf
                                        <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-success-sage border border-transparent rounded-md font-semibold text-xs text-primary-deep-navy uppercase tracking-widest hover:bg-success-sage/80 focus:bg-success-sage active:bg-success-sage focus:outline-none focus:ring-2 focus:ring-success-sage focus:ring-offset-2 transition ease-in-out duration-150">
                                            Borrow (Reserved by You)
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('reservations.cancel', $userReservation) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-rich-burgundy border border-transparent rounded-md font-semibold text-xs text-primary-warm-cream uppercase tracking-widest hover:bg-primary-rich-burgundy/80 focus:bg-primary-rich-burgundy active:bg-primary-rich-burgundy focus:outline-none focus:ring-2 focus:ring-primary-rich-burgundy focus:ring-offset-2 transition ease-in-out duration-150">
                                            Cancel Reservation
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 bg-secondary-light-gray border border-transparent rounded-md font-semibold text-xs text-secondary-charcoal-gray uppercase tracking-widest">
                                        Reserved
                                    </span>
                                @endif
                            @elseif ($livre->statut === 'emprunté')
                                {{-- Check if borrowed by current user to allow returning --}}
                                @php
                                    $userEmprunt = $livre->emprunts->firstWhere('user_id', Auth::id());
                                @endphp
                                @if ($userEmprunt)
                                    <form method="POST" action="{{ route('emprunts.return', $userEmprunt) }}">
                                        @csrf
                                        <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-rich-burgundy border border-transparent rounded-md font-semibold text-xs text-primary-warm-cream uppercase tracking-widest hover:bg-primary-rich-burgundy/80 focus:bg-primary-rich-burgundy active:bg-primary-rich-burgundy focus:outline-none focus:ring-2 focus:ring-primary-rich-burgundy focus:ring-offset-2 transition ease-in-out duration-150">
                                            Return
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 bg-secondary-light-gray border border-transparent rounded-md font-semibold text-xs text-secondary-charcoal-gray uppercase tracking-widest">
                                        Borrowed
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $livres->links() }}
            </div>
        </div>
    </div>
</x-app-layout>