<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="makeBooking">
        <div class="mb-4">
            <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
            <input type="date" id="startDate" wire:model.defer="startDate"
                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
            <input type="date" id="endDate" wire:model.defer="endDate"
                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('endDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if ($message)
            {{-- Affiche le message de confirmation ou d'erreur --}}
            <div class="mb-4 p-3 rounded-md
                @if($messageType === 'success') bg-green-100 text-green-700 @else bg-red-100 text-red-700 @endif">
                {{ $message }}
            </div>
        @endif

        <button type="submit"
                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition ease-in-out duration-150">
            Réserver maintenant
        </button>
    </form>
</div>