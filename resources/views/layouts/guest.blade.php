<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SISPortafolio</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{asset('image/escudoEscuela.svg')}}" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center pt-6 sm:pt-0 bg-gray-100">
        <div class="max-w-full w-full mx-auto ">
            <div class="flex flex-row sm:flex-row justify-between items-center" >
                <div class="h-screen overflow-hidden" style="height: 100vh;">
                    <img src="{{ asset('image/Rectangle.png') }}" alt="Logo" class="h-full object-cover" />
                </div>
                <div class="flex justify-center w-1/2 h-full" style="width: 50%">   
                    <div
                        class="w-1 sm:mt-0 px-6 py-4 bg-white shadow-md sm:rounded-lg" style="width: 80%; margin-right:150px;">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>

</style>

</html>
