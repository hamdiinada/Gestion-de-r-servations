<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-primary mb-4">{{ __("Bienvenue sur votre tableau de bord !") }}</h3>
                    <p class="mb-6">{{ __("Ici, vous pouvez voir les propriétés disponibles et gérer vos réservations.") }}</p>

                    <div class="flex flex-wrap -mx-4">
                        @forelse ($properties as $property)
                            <div class="w-full sm:w-1/2 lg:w-1/3 px-4 mb-8">
                                <a href="{{ route('properties.show', $property->id) }}" class="block">
                                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                        {{-- Image placeholder pour la propriété --}}
                                        <img src="https://placehold.co/400x250/1E40AF/FFFFFF?text=Property+Image" alt="Image de la propriété" class="w-full h-48 object-cover rounded-t-lg">
                                        <div class="p-6">
                                            <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $property->name }}</h4>
                                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $property->description }}</p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-primary font-bold text-lg">{{ number_format($property->price_per_night, 2) }} TND / Nuit</span>
                                                <x-primary-button>Voir les détails</x-primary-button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="w-full px-4 text-center text-gray-600">
                                <p>{{ __("Aucune propriété disponible pour le moment.") }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>