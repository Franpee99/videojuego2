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

                <!-- Componente Livewire para Selección de Distribuidora y Desarrolladora -->
                @livewire('seleccion-distribuidora', [
                    'distribuidora_id' => $videojuego->desarrolladora->distribuidora_id ?? null,
                    'desarrolladora_id' => $videojuego->desarrolladora_id ?? null
                ])

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Editar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
