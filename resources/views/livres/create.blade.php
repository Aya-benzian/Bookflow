<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.livres.store') }}">
                        @csrf

                        <!-- Titre -->
                        <div>
                            <x-input-label for="titre" :value="__('Title')" />
                            <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" :value="old('titre')" required autofocus />
                            <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                        </div>

                        <!-- Auteur -->
                        <div class="mt-4">
                            <x-input-label for="auteur" :value="__('Author')" />
                            <x-text-input id="auteur" class="block mt-1 w-full" type="text" name="auteur" :value="old('auteur')" required />
                            <x-input-error :messages="$errors->get('auteur')" class="mt-2" />
                        </div>

                        <!-- Genre -->
                        <div class="mt-4">
                            <x-input-label for="genre" :value="__('Genre')" />
                            <x-text-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre')" required />
                            <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Statut (default to disponible) -->
                        <div class="mt-4">
                            <x-input-label for="statut" :value="__('Status')" />
                            <select id="statut" name="statut" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="disponible" {{ old('statut', 'disponible') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="emprunté" {{ old('statut') == 'emprunté' ? 'selected' : '' }}>Emprunté</option>
                                <option value="reservé" {{ old('statut') == 'reservé' ? 'selected' : '' }}>Reservé</option>
                            </select>
                            <x-input-error :messages="$errors->get('statut')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Add Book') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
