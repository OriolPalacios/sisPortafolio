<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Hola!
                    <p>{{ __('Nombre: ') . Auth::user()->nombres . " " . Auth::user()->apellido_paterno . " " . Auth::user()->apellido_materno }}</p>
                    <p>{{ __('Correo: ') . Auth::user()->correo }}</p>
                    <p>{{ __('Rol: ') . Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>