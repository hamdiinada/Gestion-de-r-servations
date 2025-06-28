<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $property->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            {{-- Image placeholder pour la propriété --}}
                            <img src="https://placehold.co/600x400/1E40AF/FFFFFF?text=Property+Image" alt="Image de la propriété" class="w-full h-auto rounded-lg shadow-md mb-6">
                            <h3 class="text-2xl font-bold text-primary mb-4">{{ $property->name }}</h3>
                            <p class="text-gray-700 mb-4">{{ $property->description }}</p>
                            <p class="text-xl font-bold text-gray-900">{{ number_format($property->price_per_night, 2) }} TND / Nuit</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary mb-4">{{ __("Réserver cette Propriété") }}</h3>
                            {{-- Inclut le composant Livewire BookingManager, en lui passant la propriété --}}
                            @livewire('booking-manager', ['property' => $property])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>