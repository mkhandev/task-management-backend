<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <div class="border-solid border-b border-gray-200  w-full">

        <div class="container mx-auto bg-blue">
            <div class="p-4 flex items-center justify-between">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <div class="text-xl text-[#2E3033] text-center">
                    Task Management
                </div>
            </div>
        </div>
    </div>


    <div class="container mx-auto">
        @yield('content')
    </div>


    <footer>
       
    </footer>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Add your JS file -->
</body>

</html>
