<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $livre->titre }}</h3>
                    <p class="text-gray-700"><strong>Author:</strong> {{ $livre->auteur }}</p>
                    <p class="text-gray-700"><strong>Genre:</strong> {{ $livre->genre }}</p>
                    <p class="text-gray-700"><strong>Status:</strong> {{ ucfirst($livre->statut) }}</p>
                    <p class="text-gray-600 mt-2">{{ $livre->description }}</p>

                    <div class="mt-4">
                        <a href="{{ route('livres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to Catalog
                        </a>
                        {{-- Add borrow/reserve/return buttons here if needed --}}
                        @if ($livre->statut === 'disponible')
                            <form method="POST" action="{{ route('emprunts.store') }}" class="inline-block">
                                @csrf
                                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Borrow
                                </button>
                            </form>
                            <form method="POST" action="{{ route('reservations.store') }}" class="inline-block">
                                @csrf
                                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Reserve
                                </button>
                            </form>
                        @elseif ($livre->statut === 'reservé')
                            @php
                                $userReservation = $livre->reservations->firstWhere('user_id', Auth::id());
                            @endphp
                            @if ($userReservation)
                                <form method="POST" action="{{ route('emprunts.store') }}" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Borrow (Reserved by You)
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('reservations.cancel', $userReservation) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Cancel Reservation
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest">
                                    Reserved
                                </span>
                            @endif
                        @elseif ($livre->statut === 'emprunté')
                            @php
                                $userEmprunt = $livre->emprunts->firstWhere('user_id', Auth::id());
                            @endphp
                            @if ($userEmprunt)
                                <form method="POST" action="{{ route('emprunts.return', $userEmprunt) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Return
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest">
                                    Borrowed
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>