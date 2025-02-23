<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar videojuego
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('videojuegos.update', $videojuego) }}" class="max-w-sm mx-auto">
                @method('PUT')
                @csrf

                <div class="mb-5">
                    <x-input-label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nombre
                    </x-input-label>
                    <x-text-input name="nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('nombre', $videojuego->nombre)" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>

                <!-- Componente Livewire para Selección de Distribuidora y Desarrolladora -->
                @livewire('seleccion-distribuidora', [
                    'distribuidora_id' => $videojuego->desarrolladora->distribuidora_id ?? null,
                    'desarrolladora_id' => $videojuego->desarrolladora_id ?? null
                ])

                <!-- Campo oculto para asegurarse de que desarrolladora_id se envía -->
                <input type="hidden" name="desarrolladora_id" id="desarrolladora_id" value="{{ old('desarrolladora_id', $videojuego->desarrolladora_id) }}">

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Editar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
