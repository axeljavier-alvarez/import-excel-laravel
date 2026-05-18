<div class="min-h-[80vh] flex items-center justify-center px-4">

    <div class="w-full max-w-xl bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden">

        <!-- Header -->
        <div class="p-6 bg-blue-600 text-white">
            <h3 class="text-xl font-bold">
                Importación Masiva de Vecinos
            </h3>

            <p class="text-sm text-blue-100 mt-1">
                Sube el archivo unificado de respuestas (.xlsx o .csv).
            </p>
        </div>

        <div class="p-6 space-y-5">

            <!-- Success -->
            @if (session()->has('message'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    class="p-4 text-sm text-green-800 bg-green-50 border-l-4 border-green-500 rounded-r-lg"
                >
                    <span class="font-bold">Completado:</span>
                    {{ session('message') }}
                </div>
            @endif

            <!-- Error -->
            @if (session()->has('error'))
                <div class="p-4 text-sm text-red-800 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <span class="font-bold">Atención:</span>
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="import" class="space-y-4">

                <!-- Upload -->
                <div class="relative">

                    <label
                        for="file-upload"
                        class="group flex flex-col items-center justify-center h-40 p-4 text-center border-2 border-dashed rounded-xl cursor-pointer transition
                        {{ $file
                            ? 'border-blue-300 bg-blue-50'
                            : 'border-gray-300 bg-gray-50 hover:border-blue-500 hover:bg-gray-100'
                        }}"
                    >

                        <svg
                            class="w-10 h-10 mb-3 transition text-gray-400 group-hover:text-blue-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            />
                        </svg>

                        @if ($file)

                            <p class="text-sm font-semibold text-blue-700 truncate max-w-xs">
                                {{ $file->getClientOriginalName() }}
                            </p>

                            <p class="text-xs text-blue-500 mt-1">
                                Haga clic para cambiar el archivo
                            </p>

                        @else

                            <p class="text-sm font-medium text-gray-600">
                                Haga clic para buscar o arrastre el archivo
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                EXCEL (.xlsx) o CSV — Máx. 10MB
                            </p>

                        @endif

                        <input
                            id="file-upload"
                            type="file"
                            wire:model="file"
                            class="hidden"
                        />
                    </label>

                    <!-- Remove File -->
                    @if ($file)
                        <button
                            type="button"
                            wire:click="removeFile"
                            class="absolute top-3 right-3 flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-200 shadow-sm hover:bg-red-50 hover:border-red-200 hover:text-red-600 transition"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    @endif

                </div>

                @error('file')
                    <p class="text-xs font-semibold text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                <!-- Uploading -->
                <div
                    wire:loading.flex
                    wire:target="file"
                    class="items-center gap-3 p-3 text-sm font-medium rounded-xl bg-amber-50 border border-amber-200 text-amber-700"
                >
                    <svg
                        class="w-5 h-5 animate-spin flex-shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V4a8 8 0 00-8 8z"
                        />
                    </svg>

                    <span>
                        Subiendo archivo...
                    </span>
                </div>

                <!-- Importing -->
                <div
                    wire:loading.flex
                    wire:target="import"
                    class="items-center gap-3 p-3 text-sm font-medium rounded-xl bg-blue-50 border border-blue-200 text-blue-700"
                >
                    <svg
                        class="w-5 h-5 animate-spin flex-shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V4a8 8 0 00-8 8z"
                        />
                    </svg>

                    <span>
                        Procesando registros...
                    </span>
                </div>

                <!-- Button -->
                <div class="flex justify-end">

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-40 transition"
                    >
                        Procesar Hoja de Excel
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>