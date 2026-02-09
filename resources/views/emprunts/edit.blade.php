<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-navy leading-tight">
            {{ __('Edit Loan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-creamy overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-text-on-creamy">
                    <form method="POST" action="{{ route('emprunts.update', $emprunt) }}">
                        @csrf
                        @method('patch')

                        <!-- Book Selection (can be read-only or editable based on business logic) -->
                        <div>
                            <x-input-label for="book_id" :value="__('Book')" />
                            <select id="book_id" name="book_id" class="block mt-1 w-full" required autofocus>
                                {{-- Loop through available books --}}
                                {{-- @foreach ($books as $book)
                                    <option value="{{ $book->id }}" @selected(old('book_id', $emprunt->book_id) == $book->id)>{{ $book->title }}</option>
                                @endforeach --}}
                                <option value="{{ $emprunt->book_id }}" selected>{{ $emprunt->book->title ?? 'Selected Book' }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>

                        <!-- Due Date -->
                        <div class="mt-4">
                            <x-input-label for="date_retour_prevue" :value="__('Due Date')" />
                            <x-text-input id="date_retour_prevue" class="block mt-1 w-full" type="date" name="date_retour_prevue" :value="old('date_retour_prevue', $emprunt->date_retour_prevue ? \Carbon\Carbon::parse($emprunt->date_retour_prevue)->format('Y-m-d') : '')" required />
                            <x-input-error :messages="$errors->get('date_retour_prevue')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>