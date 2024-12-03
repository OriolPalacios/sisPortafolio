<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    {{-- inset the svg at address asset('image/escuedoEscuela.svg)') --}}
        <div class="flex justify-center">
            <img src="{{ asset('image/escudoEscuela.svg') }}" alt="Escudo de la escuela" class="w-40 h-40  bg-gray-200 rounded-full">
        </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="correo" :value="__('Correo')" />
            <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="contrasena" :value="__('Contraseña')" />

            <x-text-input id="contrasena" class="block mt-1 w-full"
                            type="password"
                            name="contrasena"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('contrasena')" class="mt-2" />
        </div>

        {{-- Role --}}

        <div class="mt-4">
            <x-input-label for="role" :value="__('Rol')" />

            <select name="role" id="role" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700   shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                <option value="Docente">Docente</option>
                <option value="Revisor">Revisor</option>
                <option value="Administrador">Administrador</option>
            </select>

           <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>


        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm ">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
