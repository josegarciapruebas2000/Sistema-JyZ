<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Rol</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #logo {
            filter: drop-shadow(10px 20px 10px rgba(0, 0, 0, 0.353));
            border-radius: 80px;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#404040] via-[#262626] to-[#59554D] flex items-center justify-center min-h-screen">

    <!-- Modal para seleccionar rol -->
    <div class="bg-[#262626] p-8 rounded-lg shadow-2xl w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('/img/logo-mov.gif') }}" alt="Logo" width="150" id="logo">
        </div>

        <h2 class="text-2xl font-bold text-[#F2D0A7] mb-6 text-center">¿Quién eres?</h2>

        <div class="flex flex-col space-y-4">
            <button onclick="seleccionarRol('admin')"
                class="bg-gradient-to-r from-[#A69177] to-[#F2D0A7] hover:from-[#F2D0A7] hover:to-[#A69177] text-[#262626] font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105">
                Administrador
            </button>
            <button onclick="seleccionarRol('cliente')"
                class="bg-gradient-to-r from-[#A69177] to-[#F2D0A7] hover:from-[#F2D0A7] hover:to-[#A69177] text-[#262626] font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105">
                Cliente
            </button>
        </div>
    </div>

    <script>
        function seleccionarRol(rol) {
            if (rol === 'admin') {
                // Redirigir a la ruta específica en Laravel para el login de administrador
                window.location.href = '{{ route("loginAdmin") }}';
            } else if (rol === 'cliente') {
                // Mostrar mensaje de bienvenida para el cliente
                Swal.fire({
                    title: 'Bienvenido a JyZ Fotografía',
                    html: `
                    <p>El inicio de sesión es exclusivo para cada escuela. Si ha perdido el acceso correspondiente a su institución, por favor, <a href="https://api.whatsapp.com/send?phone=+9221647818&text=He%20perdido%20el%20acceso%20a%20mi%20inicio%20de%20sesión%20escolar" target="_blank" class="text-green-500 underline">comuníquese con nosotros</a> o con la persona encargada de su grupo para recibir asistencia.</p>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#A69177',
                    customClass: {
                        popup: 'bg-[#262626] text-[#F2D0A7]',
                        title: 'text-2xl font-bold',
                        content: 'text-lg',
                        confirmButton: 'bg-[#A69177] text-[#262626] rounded-lg py-2 px-4'
                    }
                })
            }
        }
    </script>

</body>

</html>
