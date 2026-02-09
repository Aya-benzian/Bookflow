<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('My Loans') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-text">
                <h3 class="text-lg font-medium text-primary mb-4">Current Loans</h3>

                @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="mb-4">
                    <a href="{{ route('admin.emprunts.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add New Loan') }}
                    </a>
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary-dark">
                        <thead class="bg-secondary-dark">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                                    Book Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                                    Loan Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-secondary divide-y divide-secondary-dark">
                            @foreach ($emprunts as $emprunt)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-text">{{ $emprunt->livre->titre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-text">{{ $emprunt->date_emprunt->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-text">
                                            @if ($emprunt->date_retour_prevue)
                                                {{ $emprunt->date_retour_prevue->format('M d, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form class="inline-block" action="{{ route('emprunts.return', $emprunt) }}" method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                                            @csrf
                                            <button type="submit" class="text-accent hover:text-primary-light">Return</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-6">
                    {{ $emprunts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
