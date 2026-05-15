<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Importar Listado de Vecinos</h3>
        <p class="text-sm text-gray-600">Seleccione el archivo .xlsx o .csv generado por el formulario.</p>
    </div>

    <form wire:submit.prevent="import">
        <div class="mb-4">
            <input type="file" wire:model="file" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            
            @error('file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div wire:loading wire:target="file" class="mb-4 text-blue-600 text-sm italic">
            Cargando archivo...
        </div>

        <button type="submit" 
            wire:loading.attr="disabled"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 transition-colors">
            <span wire:loading.remove wire:target="import">Procesar Excel</span>
            <span wire:loading wire:target="import">Importando datos...</span>
        </button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-md">
            {{ session('error') }}
        </div>
    @endif
</div>