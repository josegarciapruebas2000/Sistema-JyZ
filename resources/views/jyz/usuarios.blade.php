@extends('base')

@section('title', 'Lista de Usuarios')

@section('content')
    <h1 class="text-2xl md:text-3xl font-bold text-center mt-4" style="color: #A69177;">LISTA DE USUARIOS</h1>

    <div class="flex justify-end space-x-2 px-4 mt-6">
        <button id="open-add-user-modal" type="button"
            class="py-2 px-4 bg-[#A69177] text-white rounded-lg shadow transition duration-300 hover:bg-[#8B5D33]">Agregar
            Usuario</button>
        <a href="/regresar" class="text-decoration-none">
            <button type="button"
                class="py-2 px-4 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">Regresar</button>
        </a>
    </div>

    <!-- Buscador -->
    <div class="px-4 mt-6">
        <input type="text" id="search-input" placeholder="Buscar por ID, Nombre o Teléfono"
            class="w-full md:w-2/3 lg:w-1/2 py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#A69177]">
    </div>


    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    @if (Auth::user()->role == 'jyz')
                        <th class="py-2 px-4 text-xs md:text-sm">ID</th>
                        <th class="py-2 px-4 text-xs md:text-sm">Nombre</th>
                        <th class="py-2 px-4 text-xs md:text-sm">Teléfono</th>
                        <th class="py-2 px-4 text-xs md:text-sm">Acciones</th>
                    @else
                        <!-- Ajustar encabezados según el rol si es necesario -->
                    @endif
                </tr>
            </thead>
            <tbody id="users-table-body">
                @foreach ($usuarios as $usuario)
                    @if (Auth::user()->id !== $usuario->id)
                        <tr class="text-center border-b {{ $usuario->status == 0 ? 'bg-red-100' : 'bg-white' }}">
                            @if (Auth::user()->role == 'jyz')
                                <td class="py-2 px-4 text-xs md:text-sm">{{ $usuario->id }}</td>
                                <td class="py-2 px-4 text-xs md:text-sm">{{ $usuario->nombre }}</td>
                                <td class="py-2 px-4 text-xs md:text-sm">{{ $usuario->telefono }}</td>
                                <td class="py-2 px-4 text-xs md:text-sm flex justify-center space-x-2">
                                    <button
                                        class="edit-user-button py-1 px-3 bg-blue-500 text-white rounded-lg shadow transition duration-300 hover:bg-blue-700"
                                        data-id="{{ $usuario->id }}">Editar</button>

                                    <form action="{{ route('usuarios.toggleStatus', $usuario->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="py-1 px-3 {{ $usuario->status == 0 ? 'bg-green-500 hover:bg-green-600' : 'bg-yellow-500 hover:bg-yellow-600' }} text-white rounded-lg shadow transition duration-300">
                                            {{ $usuario->status == 0 ? 'Habilitar' : 'Deshabilitar' }}
                                        </button>
                                    </form>

                                    <button
                                        class="delete-user-button py-1 px-3 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition duration-300"
                                        data-id="{{ $usuario->id }}" data-name="{{ $usuario->nombre }}">Eliminar</button>
                                </td>
                            @else
                                <!-- Ajustar columnas y botones según el rol si es necesario -->
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Función para buscar en la tabla
        document.getElementById('search-input').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const nombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const telefono = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (id.includes(searchValue) || nombre.includes(searchValue) || telefono.includes(
                        searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Mostrar el modal para agregar un usuario
        document.getElementById('open-add-user-modal').addEventListener('click', function() {
            Swal.fire({
                title: 'Agregar Usuario',
                html: `
                    <form id="add-user-form">
                        <input type="text" id="nombre" class="swal2-input" placeholder="Nombre" required>
                        <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono" required minlength="10" maxlength="10" pattern="\\d{10}" inputmode="numeric">
                        <div style="position: relative;">
                            <input type="password" id="password" class="swal2-input" placeholder="Contraseña (4 dígitos)" pattern="\\d{4}" maxlength="4" inputmode="numeric" required>
                            <button type="button" id="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                    </form>
                `,
                confirmButtonText: 'Agregar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const nombre = Swal.getPopup().querySelector('#nombre').value;
                    const telefono = Swal.getPopup().querySelector('#telefono').value;
                    const password = Swal.getPopup().querySelector('#password').value;
                    const csrfToken = Swal.getPopup().querySelector('#csrf-token').value;

                    if (telefono.length !== 10) {
                        Swal.showValidationMessage('El teléfono debe ser de 10 dígitos.');
                        return false;
                    }

                    if (!/^\d{4}$/.test(password)) {
                        Swal.showValidationMessage('La contraseña debe ser de 4 números.');
                        return false;
                    }

                    return {
                        nombre: nombre,
                        telefono: telefono,
                        password: password,
                        _token: csrfToken
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/usuarios/guardarUsuario', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': result.value._token
                            },
                            body: JSON.stringify({
                                nombre: result.value.nombre,
                                telefono: result.value.telefono,
                                password: result.value.password
                            })
                        })
                        .then(response => response.json().then(data => ({
                            status: response.status,
                            body: data
                        })))
                        .then(({
                            status,
                            body
                        }) => {
                            if (status === 200) {
                                Swal.fire('Usuario agregado!', '', 'success');
                                window.location.reload();
                            } else {
                                console.error(body);
                                Swal.fire('Error', 'No se pudo agregar el usuario: ' + body.message,
                                    'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'No se pudo agregar el usuario', 'error');
                        });
                }
            });

            // Evitar la entrada de letras en el campo de teléfono y contraseña
            document.getElementById('telefono').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            document.getElementById('password').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            // Toggle de visibilidad de contraseña
            document.getElementById('toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const passwordType = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = passwordType;
                this.innerHTML = passwordType === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>';
            });
        });

        // Mostrar el modal para editar un usuario
        document.querySelectorAll('.edit-user-button').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                // Obtener los datos del usuario
                fetch(`/usuarios/${userId}`)
                    .then(response => response.json())
                    .then(user => {
                        Swal.fire({
                            title: 'Editar Usuario',
                            html: `
                                <form id="edit-user-form">
                                    <input type="text" id="nombre" class="swal2-input" value="${user.nombre}" required>
                                    <input type="text" id="telefono" class="swal2-input" value="${user.telefono}" required minlength="10" maxlength="10" pattern="\\d{10}" inputmode="numeric">
                                    <div style="position: relative;">
                                        <input type="password" id="password" class="swal2-input" placeholder="Nueva Contraseña (4 dígitos, dejar vacío si no se cambia)" pattern="\\d{4}" maxlength="4" inputmode="numeric">
                                        <button type="button" id="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="${userId}">
                                </form>
                            `,
                            confirmButtonText: 'Guardar',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar',
                            preConfirm: () => {
                                const nombre = Swal.getPopup().querySelector('#nombre')
                                    .value;
                                const telefono = Swal.getPopup().querySelector('#telefono')
                                    .value;
                                const password = Swal.getPopup().querySelector('#password')
                                    .value;
                                const csrfToken = Swal.getPopup().querySelector(
                                    '#csrf-token').value;
                                const userId = Swal.getPopup().querySelector('#user-id')
                                    .value;

                                if (telefono.length !== 10) {
                                    Swal.showValidationMessage(
                                        'El teléfono debe ser de 10 dígitos.');
                                    return false;
                                }

                                if (password && !/^\d{4}$/.test(password)) {
                                    Swal.showValidationMessage(
                                        'La contraseña debe ser de 4 números si se ingresa.'
                                        );
                                    return false;
                                }

                                return {
                                    nombre: nombre,
                                    telefono: telefono,
                                    password: password,
                                    _token: csrfToken,
                                    _method: 'PATCH',
                                    userId: userId
                                };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/usuarios/${result.value.userId}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': result.value._token
                                        },
                                        body: JSON.stringify({
                                            nombre: result.value.nombre,
                                            telefono: result.value.telefono,
                                            password: result.value.password,
                                            _method: 'PATCH'
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        Swal.fire('Usuario editado!', '', 'success');
                                        // Recargar la página para mostrar los cambios
                                        window.location.reload();
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error', 'No se pudo editar el usuario',
                                            'error');
                                    });
                            }
                        });

                        // Toggle de visibilidad de contraseña
                        document.getElementById('toggle-password').addEventListener('click',
                            function() {
                                const passwordInput = document.getElementById('password');
                                const passwordType = passwordInput.type === 'password' ? 'text' :
                                    'password';
                                passwordInput.type = passwordType;
                                this.innerHTML = passwordType === 'password' ?
                                    '<i class="fas fa-eye"></i>' :
                                    '<i class="fas fa-eye-slash"></i>';
                            });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'No se pudieron obtener los datos del usuario', 'error');
                    });
            });
        });

        // Mostrar el modal para confirmar la eliminación de un usuario
        document.querySelectorAll('.delete-user-button').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Eliminar Usuario',
                    text: '¿Estás seguro de que deseas eliminar este usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/usuarios/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire('Usuario eliminado!', '', 'success');
                                window.location.reload();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'No se pudo eliminar el usuario', 'error');
                            });
                    }
                });
            });
        });

        // Toggle de habilitación/deshabilitación de usuario
        document.querySelectorAll('.toggle-status-button').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                fetch(`/usuarios/${userId}/toggle-status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'No se pudo cambiar el estado del usuario', 'error');
                    });
            });
        });
    </script>

    <style>
        .swal-button {
            background-color: #1F2937 !important;
            color: white !important;
            border: none !important;
            border-radius: 0.25rem !important;
            padding: 0.5rem 1rem !important;
            font-size: 1rem !important;
        }
    </style>
@endsection
