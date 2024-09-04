<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
        }

        #logo {
            filter: drop-shadow(3px 3px 3px rgba(0, 0, 0, 0.2));
            border-radius: 80px;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#404040] via-[#262626] to-[#59554D] flex items-center justify-center min-h-screen">
    <div class="bg-[#262626] p-8 rounded-lg shadow-2xl w-full max-w-md animate-slideIn">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('/img/logo-mov.gif') }}" alt="Logo" width="150" id="logo">
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="mb-5">
                <label for="escuela" class="block text-[#F2D0A7] text-sm font-semibold mb-2">Escuela</label>
                <input type="text" id="escuela" name="escuela"
                    class="shadow-md appearance-none border border-[#59554D] rounded-lg w-full py-3 px-4 text-[#A69177] leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                    required>
            </div>

            <div class="mb-5">
                <label for="telefono" class="block text-[#F2D0A7] text-sm font-semibold mb-2">Teléfono</label>
                <input type="text" id="telefono" name="telefono"
                    class="shadow-md appearance-none border border-[#59554D] rounded-lg w-full py-3 px-4 text-[#A69177] leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-[#F2D0A7] text-sm font-semibold mb-2">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="shadow-md appearance-none border border-[#59554D] rounded-lg w-full py-3 px-4 text-[#A69177] mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                    required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-gradient-to-r from-[#A69177] to-[#F2D0A7] text-[#262626] font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105">Registrar</button>
                <a href="{{ route('login') }}"
                    class="inline-block align-baseline font-semibold text-sm text-[#F2D0A7] hover:text-[#A69177] transition duration-500">Iniciar sesión</a>
            </div>
        </form>
    </div>
</body>

</html>
