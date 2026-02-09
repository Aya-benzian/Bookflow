<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-text">
                <h3 class="text-lg font-medium text-primary mb-4">Current Reservations</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary-dark">
                        <thead class="bg-secondary-dark">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                                    Book Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                                    Reservation Date
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-secondary divide-y divide-secondary-dark">
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-text">{{ $reservation->livre->titre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-text">{{ $reservation->date_reservation->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form class="inline-block" action="{{ route('reservations.cancel', $reservation) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-500">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-6">
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
