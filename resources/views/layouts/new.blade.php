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
</head>

<body>


    <header class="p-4 text-white bg-blue-600">
        <div class="container flex items-center justify-between mx-auto">
            <h1 class="text-2xl font-bold">My App</h1>
            <!-- Button visible only on small screens (md:hidden) -->
            <button class="md:hidden" id="toggle-sidebar"> <!-- Button for toggling sidebar -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="#be312d">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>


    <div class="flex">
        <!-- Sidebar: Always visible on desktop (md and larger), hidden by default on smaller screens -->
        <aside id="sidebar"
            class="fixed z-30 w-64 h-screen transition-transform transform bg-white shadow-md md:relative md:translate-x-0 sidebar-hidden md:block">
            <!-- Sidebar is hidden by default on small screens, visible on md+ -->
            <div class="p-4">
                <nav>
                    <ul>
                        <li class="mb-2"><a href="#"
                                class="block p-2 text-white bg-blue-600 rounded">Dashboard</a></li>
                        <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-gray-100">Settings</a>
                        </li>
                        <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-gray-100">Profile</a>
                        </li>
                        <li><a href="#" class="block p-2 rounded hover:bg-gray-100">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Container -->
        <main class="flex-1 p-4 md:ml-64"> <!-- Add md:ml-64 to leave space for sidebar -->
            <div class="container mx-auto">
                <h2 class="mb-4 text-xl font-bold">Welcome to the Dashboard</h2>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <p>This is the main content area.</p>
                </div>
            </div>
        </main>
    </div>

    <!-- jQuery Script -->
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

</body>

</html>
