<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @stack('css')
    <style>
        @media only screen and (max-width: 768px) {
            .sidebar-hidden {
                transform: translateX(-100%) !important;
            }

        }
    </style>

    <script>
        $(document).ready(function() {
            $('#toggle-sidebar').click(function() {
                $('#sidebar').toggleClass('sidebar-hidden');
            });

            $(window).resize(function() {
                if ($(window).width() >= 768) {
                    // Remove sidebar-hidden class on screens >= 768px
                    $('#sidebar').removeClass('sidebar-hidden');

                    console.log($(window).width());

                } else {
                    // Add sidebar-hidden class on screens < 768px
                    $('#sidebar').addClass('sidebar-hidden');
                }
            });

        });
    </script>
</head>

<body class="bg-[#fafafb]">
    <div class="fixed w-full bg-white border-b border-gray-200 border-solid md:relative">

        <div class="container mx-auto">
            <div class="flex items-center justify-between p-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <div class="text-xl text-[#2E3033] text-center hidden md:block">
                    Task Management
                </div>

                <button class="md:hidden" id="toggle-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="#be312d">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="flex min-h-[100vh]">

        @include('layouts.partial.sidebar')

        <main class="flex-1 p-4">

            @include('layouts.partial.flash')

            <div class="container mx-auto">
                @yield('content')
            </div>
        </main>
    </div>




    <!-- Stack for JavaScript -->
    @stack('js')
</body>

</html>
