<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nos Propriétés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-primary mb-4">{{ __("Découvrez nos biens immobiliers disponibles à la réservation.") }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($properties as $property)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                {{-- Image placeholder pour la propriété --}}
                                <img src="https://placehold.co/400x250/1E40AF/FFFFFF?text=Property+Image" alt="Image de la propriété" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $property->name }}</h4>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $property->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-primary font-bold text-lg">{{ number_format($property->price_per_night, 2) }} TND / Nuit</span>
                                        {{-- Lien vers la page de détails de la propriété --}}
                                        <a href="{{ route('properties.show', $property->id) }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center text-gray-600">
                                <p>{{ __("Aucune propriété n'est listée pour le moment.") }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>