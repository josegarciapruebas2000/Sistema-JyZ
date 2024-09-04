<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --navbar-height: 56px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease-out forwards;
        }

        .hover-animate:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }

        #logo {
            filter: drop-shadow(10px 20px 10px rgba(0, 0, 0, 0.353));
            border-radius: 80px;
        }

        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .menu-item:hover::before {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-white text-[#262626] font-sans antialiased">

    <div class="flex">
        <div id="sidebar"
            class="w-64 bg-[#262626] text-white fixed top-0 left-0 h-full p-6 animate-slideInLeft hidden lg:block">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('/img/logo-mov.gif') }}" alt="Logo" width="90" id="logo">
            </div>
            <h1 class="text-2xl font-bold flex justify-center mb-6">JyZ Fotografía</h1>
            <ul>
                <li class="mb-4">
                    <a href="{{ route('principal') }}"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Inicio</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('escuelas') }}"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Escuelas</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('paquetes') }}"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Paquetes</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('usuarios.index') }}"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Usuarios</a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Pagos</a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Paquete</a>
                </li>
            </ul>
        </div>

        <div class="flex-1 lg:ml-64 p-6 animate-fadeIn relative z-10">
            <div
                class="flex justify-between items-center mb-6 fixed top-0 left-0 right-0 bg-white shadow-md p-4 z-50 lg:left-64">
                <div>

                    @if (Auth::user()->role === 'jyz')
                        <div class="text-2xl font-bold">Hola, {{ Auth::user()->nombre }}</div>
                    @endif


                    @if (Auth::user()->role === 'cliente')
                        <div class="text-2xl font-bold">Hola, {{ Auth::user()->telefono }}</div>

                        <div class="text-sm text-gray-600 mt-2">
                            <span class="font-semibold">Escuela:</span> {{ $escuelaUsuario->nombre }}
                        </div>
                    @endif



                </div>
                <div class="lg:hidden">
                    <button id="menu-button" class="text-[#262626] focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:block">
                    <a href="{{ route('logout.custom') }}">
                        <button
                            class="bg-[#A69177] text-white font-bold py-2 px-4 rounded-lg transition duration-500 transform hover:scale-105">Cerrar
                            sesión</button>
                    </a>

                </div>
            </div>

            <div id="mobile-sidebar"
                class="bg-[#262626] text-white p-6 lg:hidden hidden animate-slideInLeft fixed top-0 left-0 h-full w-64 z-50">
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('principal') }}"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Inicio</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('escuelas') }}"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Escuelas</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('paquetes') }}"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Paquetes</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('usuarios.index') }}"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Usuarios</a>
                    </li>
                    <li class="mb-4">
                        <a href="#"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Pagos</a>
                    </li>
                    <li class="mb-4">
                        <a href="#"
                            class="block p-4 text-[#F2D0A7] transition duration-500 hover:bg-[#F2D0A7] hover:text-[#262626] rounded-lg">Paquete</a>
                    </li>
                </ul>
                <a href="{{ route('logout.custom') }}">
                    <button
                        class="bg-[#A69177] text-white font-bold py-2 px-4 rounded-lg w-full mt-4 transition duration-500 transform hover:scale-105">Cerrar
                        sesión</button>
                </a>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg animate-fadeIn mt-20">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            const mobileSidebar = document.getElementById('mobile-sidebar');
            if (mobileSidebar.classList.contains('hidden')) {
                mobileSidebar.classList.remove('hidden');
            } else {
                mobileSidebar.classList.add('hidden');
            }
        });

        async function fetchWeather() {
            const response = await fetch(
                'https://api.openweathermap.org/data/2.5/weather?q=Mexico%20City,mx&appid=YOUR_API_KEY');
            const data = await response.json();
            const currentTime = new Date().getHours();
            const greetingElement = document.getElementById('greeting');

            let greeting;
            if (currentTime >= 6 && currentTime < 12) {
                greeting = "Buenos días, usuario";
            } else if (currentTime >= 12 && currentTime < 18) {
                greeting = "Buenas tardes, usuario";
            } else {
                greeting = "Buenas noches, usuario";
            }

            greetingElement.textContent = greeting;
        }

        fetchWeather();
    </script>
</body>

</html>
