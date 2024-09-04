@extends('base')

@section('title', 'Formulario Centrado y Responsivo')

@section('content')
    <div class="text-center text-2xl font-bold text-gray-800">{{ $escuela->tipo }}</div>

    <h1 class="text-2xl md:text-3xl font-bold text-center mt-4" style="color: #A69177;">"{{ strtoupper($escuela->nombre) }}"
    </h1>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Errores en el formulario',
                    html: `<ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>`,
                    confirmButtonColor: '#A69177'
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#A69177'
                });
            });
        </script>
    @endif

    <div>
        <div class="text-center text-lg text-gray-600">{{ $escuela->turno }}</div>
        <div class="text-center text-lg text-gray-600"><strong>Generación: {{ $escuela->inicio_generacion }} -
                {{ $escuela->fin_generacion }}</strong></div>

        <form class="space-y-6" action="{{ route('datos.add', ['id' => $escuela->id]) }}" method="POST"
            onsubmit="return validarFormulario();">
            @csrf

            <!-- Datos del tutor -->
            <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                <div class="text-center text-xl font-bold text-gray-800 mb-4">Datos del Tutor</div>

                <div id="mensajeAlerta"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tutor" class="block text-base font-medium text-gray-700">Nombre del tutor:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="tutor" name="tutor" placeholder="Ingrese nombre del tutor(a)"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div>
                        <label for="direccion" class="block text-base font-medium text-gray-700">Dirección:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="direccion" name="direccion" placeholder="Ingrese Calle, N° Casa y Colonia"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div>
                        <label for="telefono" class="block text-base font-medium text-gray-700">Teléfono WhatsApp:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="telefono" name="telefono" maxlength="10" placeholder="Ingrese 10 dígitos">
                    </div>
                    <div>
                        <label for="municipio" class="block text-base font-medium text-gray-700">Municipio:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="municipio" name="municipio" value="{{ strtoupper($escuela->municipio) }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Datos del alumno -->
            <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                <div class="text-center text-xl font-bold text-gray-800 mb-4">Datos del Alumno</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre_alumno" class="block text-base font-medium text-gray-700">Nombre del
                            alumno:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="nombre_alumno" name="nombre_alumno" placeholder="Ingrese nombre del alumno(a)"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div>
                        <label for="grado" class="block text-base font-medium text-gray-700">Grado:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="grado" name="grado" placeholder="Ingrese grado"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div>
                        <label for="grupo" class="block text-base font-medium text-gray-700">Grupo:</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="grupo" name="grupo" placeholder="Ingrese grupo"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>
            </div>

            <!-- Selección de paquete -->
            <div class="p-6 bg-[#E5E7EB] rounded-lg shadow-md">
                <div class="text-center text-xl font-bold text-gray-800 mb-4" style="color: #A69177;">PAQUETE</div>
                <div class="text-center text-lg font-semibold text-gray-800 mb-6">Elige un paquete:</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="paquete" class="block text-base font-medium text-gray-700">Paquete:</label>
                        <select
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                            id="paquete" name="paquete">
                            <option selected>Seleccionar</option>
                            @foreach ($paquetes as $paquete)
                                <option value="{{ $paquete->id }}" data-precio="{{ $costosPaquetes[$paquete->id] }}"
                                    data-imagen="{{ $paquete->imagen }}">
                                    {{ $paquete->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="costo_paquete" class="block text-base font-medium text-gray-700">Costo del
                            paquete:</label>
                        <div class="mt-1 flex rounded-md shadow-lg">
                            <span
                                class="inline-flex items-center px-4 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                            <input type="text"
                                class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-3"
                                id="costo_paquete" name="costo_paquete" readonly>
                            <button type="button" onclick="mostrarImagen('paquete')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#A69177] shadow-sm hover:bg-[#8B5D33] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A69177]">
                                Ver que incluye
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Selección de modelo de fotos -->
                <div class="text-center text-lg font-semibold text-gray-800 mb-6">Elige un modelo de fotos para tu cuadro de
                    grupo:</div>
                <div class="flex justify-center mb-6">
                    <div class="w-full md:w-1/2">
                        <label for="modeloFoto" class="block text-base font-medium text-gray-700">Modelo de fotos:</label>
                        <div class="mt-1 flex rounded-md shadow-lg">
                            <select
                                class="block w-full rounded-l-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                                id="modeloFoto" name="modeloFoto">
                                <option selected>Seleccionar</option>
                                @foreach ($modelosFotos as $modelo)
                                    <option value="{{ $modelo->id }}" data-imagen="{{ $modelo->imagen }}">
                                        {{ $modelo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="mostrarImagen('modeloFoto')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#1F2937] shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1F2937] transition duration-300">
                                Ver Modelo
                            </button>
                            <button type="button" onclick="mostrarListaModelos('fotos')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#A69177] shadow-sm hover:bg-[#8B5D33] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A69177] transition duration-300">
                                Ver Todos
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Selección de modelo de marco -->
                <div class="text-center text-lg font-semibold text-gray-800 mb-6">Elige un marco para tu cuadro de grupo:
                </div>
                <div class="flex justify-center mb-6">
                    <div class="w-full md:w-1/2">
                        <label for="modeloMarco" class="block text-base font-medium text-gray-700">Modelo de
                            marco:</label>
                        <div class="mt-1 flex rounded-md shadow-lg">
                            <select
                                class="block w-full rounded-l-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                                id="modeloMarco" name="modeloMarco">
                                <option selected>Seleccionar</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}" data-imagen="{{ $modelo->imagen }}">
                                        {{ $modelo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="mostrarImagen('modeloMarco')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#1F2937] shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1F2937] transition duration-300">
                                Ver Modelo
                            </button>
                            <button type="button" onclick="mostrarListaModelos('marcos')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#A69177] shadow-sm hover:bg-[#8B5D33] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A69177] transition duration-300">
                                Ver Todos
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function mostrarImagen(type) {
                        var selectElement = document.getElementById(type);
                        var selectedOption = selectElement.options[selectElement.selectedIndex];
                        var imagen = selectedOption.getAttribute('data-imagen');

                        if (selectElement.value === 'Seleccionar' || !imagen) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Por favor, selecciona un ' + (type === 'modeloFoto' ? 'modelo de fotos' :
                                    'modelo de marco') + '.',
                                confirmButtonColor: '#A69177'
                            });
                            return;
                        }

                        Swal.fire({
                            title: 'Imagen del ' + (type === 'modeloFoto' ? 'Modelo de Fotos' : 'Modelo de Marco'),
                            imageUrl: 'data:image/jpeg;base64,' + imagen,
                            imageAlt: 'Imagen del modelo',
                            showCloseButton: true,
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                confirmButton: 'swal2-confirm-btn'
                            }
                        });
                    }

                    function mostrarListaModelos(type) {
                        var modelos = type === 'fotos' ? @json($modelosFotos) : @json($modelos);

                        var contenido = modelos.map(function(modelo) {
                            return `
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">${modelo.nombre}</h3>
                    <img src="data:image/jpeg;base64,${modelo.imagen}" alt="Imagen del modelo" class="w-full h-auto rounded-lg shadow-md mt-2">
                </div>
            `;
                        }).join('');

                        Swal.fire({
                            title: 'Lista de Modelos de ' + (type === 'fotos' ? 'Fotos' : 'Marcos'),
                            html: `<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">${contenido}</div>`,
                            width: '80%',
                            showCloseButton: true,
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                confirmButton: 'swal2-confirm-btn'
                            }
                        });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const style = document.createElement('style');
                        style.textContent = `
            .swal2-confirm-btn {
                background-color: #1F2937 !important;
                color: white !important;
                border: none !important;
                border-radius: 0.375rem !important;
                padding: 0.625rem 1.25rem !important;
                font-size: 1rem !important;
                font-weight: 600 !important;
            }
            .swal2-confirm-btn:hover {
                background-color: #374151 !important;
            }
        `;
                        document.head.append(style);
                    });
                </script>



                <!-- Selección de color -->
                <div class="text-center text-lg font-semibold text-gray-800 mb-6">Elige un color para él marco:</div>
                <div class="flex justify-center">
                    <div class="w-full md:w-1/2">
                        <label for="color" class="block text-base font-medium text-gray-700">Color de marco:</label>
                        <div class="mt-1 flex rounded-md shadow-lg">
                            <select
                                class="block w-full rounded-l-md border-gray-300 shadow-lg focus:ring-[#A69177] focus:border-[#A69177] p-3"
                                id="color" name="color">
                                <option selected>Seleccionar</option>
                                @foreach ($colores as $color)
                                    <option value="{{ $color->id }}" data-precio="{{ $color->costo }}"
                                        data-imagen="{{ $color->imagen }}">
                                        {{ $color->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="mostrarImagen('color')"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#1F2937] shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1F2937] transition duration-300">
                                Ver Color
                            </button>
                            <button type="button" onclick="mostrarListaColores()"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#A69177] shadow-sm hover:bg-[#8B5D33] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A69177] transition duration-300">
                                Ver Todos
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function mostrarImagen(type) {
                        var selectElement = document.getElementById(type);
                        var selectedOption = selectElement.options[selectElement.selectedIndex];
                        var imagen = selectedOption.getAttribute('data-imagen');

                        if (selectElement.value === 'Seleccionar' || !imagen) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Por favor, selecciona un ' + type + '.',
                                confirmButtonColor: '#A69177'
                            });
                            return;
                        }

                        Swal.fire({
                            title: 'Imagen del ' + type.charAt(0).toUpperCase() + type.slice(1),
                            imageUrl: 'data:image/jpeg;base64,' + imagen,
                            imageAlt: 'Imagen del ' + type,
                            showCloseButton: true,
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                confirmButton: 'swal2-confirm-btn'
                            }
                        });
                    }

                    function mostrarListaColores() {
                        var colores = @json($colores);

                        var contenido = colores.map(function(color) {
                            return `
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">${color.nombre}</h3>
                    <img src="data:image/jpeg;base64,${color.imagen}" alt="Imagen del color" class="w-full h-auto rounded-lg shadow-md mt-2">
                </div>
            `;
                        }).join('');

                        Swal.fire({
                            title: 'Lista de Colores',
                            html: `<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">${contenido}</div>`,
                            width: '80%',
                            showCloseButton: true,
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                confirmButton: 'swal2-confirm-btn'
                            }
                        });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const style = document.createElement('style');
                        style.textContent = `
            .swal2-confirm-btn {
                background-color: #1F2937 !important;
                color: white !important;
                border: none !important;
                border-radius: 0.375rem !important;
                padding: 0.625rem 1.25rem !important;
                font-size: 1rem !important;
                font-weight: 600 !important;
            }
            .swal2-confirm-btn:hover {
                background-color: #374151 !important;
            }
        `;
                        document.head.append(style);
                    });
                </script>

            </div>


            <style>
                .swal2-modal {
                    max-width: 90vw;
                    /* Ancho máximo del modal */
                    padding: 0;
                    /* Sin relleno para el modal */
                }

                .swal2-image {
                    width: 100%;
                    height: auto;
                    object-fit: contain;
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                function mostrarImagen(type) {
                    var selectElement = document.getElementById(type);
                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                    var imagen = selectedOption.getAttribute('data-imagen');

                    if (selectElement.value === 'Seleccionar' || !imagen) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, selecciona un ' + (type === 'modeloFoto' ? 'modelo de fotos' :
                                'modelo de marco') + '.',
                            confirmButtonColor: '#A69177'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Imagen del ' + (type === 'modeloFoto' ? 'Modelo de Fotos' : 'Modelo de Marco'),
                        imageUrl: 'data:image/jpeg;base64,' + imagen,
                        imageAlt: 'Imagen del modelo',
                        showCloseButton: true,
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            confirmButton: 'swal2-confirm-btn'
                        }
                    });
                }



                document.getElementById('paquete').addEventListener('change', function() {
                    const paqueteSeleccionado = parseInt(this.value);
                    const precioPaquete = this.options[this.selectedIndex].getAttribute('data-precio');
                    document.getElementById('costo_paquete').value = precioPaquete;
                });

                document.getElementById('telefono').addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value.length > 10) {
                        this.value = this.value.slice(0, 10);
                    }
                });

                function validarFormulario() {
                    const tutor = document.getElementById("tutor").value;
                    const direccion = document.getElementById("direccion").value;
                    const telefono = document.getElementById("telefono").value;
                    const paquete = document.getElementById("paquete").value;
                    const modelo = document.getElementById("modelo").value;
                    const color = document.getElementById("color").value;
                    const nombre_alumno = document.getElementById("nombre_alumno").value;
                    const grado = document.getElementById("grado").value;
                    const grupo = document.getElementById("grupo").value;

                    const mensajeAlerta = document.getElementById("mensajeAlerta");

                    if (tutor.trim() === "" || direccion.trim() === "" || telefono.trim() === "" || paquete === "Seleccionar" ||
                        modelo === "Seleccionar" || color === "Seleccionar" || nombre_alumno.trim() === "" || grado.trim() === "" ||
                        grupo.trim() === "") {
                        mensajeAlerta.innerHTML =
                            '<div class="bg-red-500 text-white text-center py-2 rounded-md">Por favor complete todos los campos antes de guardar.</div>';
                        return false;
                    }

                    mensajeAlerta.innerHTML = '';
                    return true;
                }
            </script>

            <div class="text-center mt-8">
                <button type="submit"
                    class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Guardar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.getElementById('paquete').addEventListener('change', function() {
            const paqueteSeleccionado = parseInt(this.value);
            const precioPaquete = this.options[this.selectedIndex].getAttribute('data-precio');
            document.getElementById('costo_paquete').value = precioPaquete;
        });

        document.getElementById('telefono').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });

        function validarFormulario() {
            const tutor = document.getElementById("tutor").value;
            const direccion = document.getElementById("direccion").value;
            const telefono = document.getElementById("telefono").value;
            const paquete = document.getElementById("paquete").value;
            const modelo = document.getElementById("modelo").value;
            const color = document.getElementById("color").value;
            const nombre_alumno = document.getElementById("nombre_alumno").value;
            const grado = document.getElementById("grado").value;
            const grupo = document.getElementById("grupo").value;

            const mensajeAlerta = document.getElementById("mensajeAlerta");

            if (tutor.trim() === "" || direccion.trim() === "" || telefono.trim() === "" || paquete === "Seleccionar" ||
                modelo === "Seleccionar" || color === "Seleccionar" || nombre_alumno.trim() === "" || grado.trim() === "" ||
                grupo.trim() === "") {
                mensajeAlerta.innerHTML =
                    '<div class="bg-red-500 text-white text-center py-2 rounded-md">Por favor complete todos los campos antes de guardar.</div>';
                return false;
            }

            mensajeAlerta.innerHTML = '';
            return true;
        }
    </script>
@endsection
