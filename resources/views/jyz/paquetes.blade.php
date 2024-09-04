@extends('base')

@section('title', 'Detalles de Paquetes')

@section('content')


    <!-- Título de la página -->
    <h1 class="text-2xl md:text-3xl font-bold text-center mt-4" style="color: #A69177;">DETALLES DE PAQUETES</h1>

    <!-- Botones debajo del título -->
    <div class="flex justify-center space-x-4 mt-6">
        <a href="{{ route('C_grupal') }}"
            class="bg-[#A69177] text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-[#8B5D33] transition duration-300 ease-in-out transform hover:scale-105">
            Cuadros de Grupos
        </a>
        <a href="{{ route('C_individual') }}"
            class="bg-[#A69177] text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-[#8B5D33] transition duration-300 ease-in-out transform hover:scale-105">
            Cuadros Individuales
        </a>
    </div>

    <!-- Reduciendo el margen superior para acercar el contenido al título -->
    <div class="mt-5"> <!-- Cambiado de mt-24 a mt-10 para menos separación -->
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

        <!-- Formulario para agregar un nuevo paquete -->
        <form class="max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6" id="agregar-paquete-form"
            action="{{ route('agregarPaquetes') }}" method="POST" onsubmit="return validarFormulario();"
            enctype="multipart/form-data">
            @csrf
            <div class="text-center text-2xl font-bold text-gray-800">Paquetes</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="col-span-1">
                    <input type="text"
                        class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                        id="nombre" name="nombre" placeholder="Nombre del paquete">
                </div>
                <div class="col-span-1 flex">
                    <span
                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                    <input type="number"
                        class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                        id="costo_paquete" name="costo_paquete" placeholder="Añadir precio">
                </div>
                <div class="col-span-1 text-center">
                    <button type="submit"
                        class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Agregar</button>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center mt-4">
                <label class="relative inline-flex items-center cursor-pointer mb-4">
                    <input type="checkbox" id="kinder" name="kinder" class="sr-only peer">
                    <div
                        class="group peer ring-0 bg-[#B5B4B3] rounded-full outline-none duration-300 after:duration-300 w-16 h-8 shadow-md peer-checked:bg-[#A69177] peer-focus:outline-none after:content-['✖️'] after:rounded-full after:absolute after:bg-gray-50 after:outline-none after:h-6 after:w-6 after:top-1 after:left-1 after:-rotate-180 after:flex after:justify-center after:items-center peer-checked:after:translate-x-8 peer-checked:after:content-['✔️'] peer-hover:after:scale-95 peer-checked:after:rotate-0">
                    </div>
                    <span class="ml-3 text-gray-700 font-medium text-sm capitalize">Kínder</span>
                </label>

                <label class="relative inline-flex items-center cursor-pointer mb-4">
                    <input type="checkbox" id="primaria" name="primaria" class="sr-only peer">
                    <div
                        class="group peer ring-0 bg-[#B5B4B3] rounded-full outline-none duration-300 after:duration-300 w-16 h-8 shadow-md peer-checked:bg-[#A69177] peer-focus:outline-none after:content-['✖️'] after:rounded-full after:absolute after:bg-gray-50 after:outline-none after:h-6 after:w-6 after:top-1 after:left-1 after:-rotate-180 after:flex after:justify-center after:items-center peer-checked:after:translate-x-8 peer-checked:after:content-['✔️'] peer-hover:after:scale-95 peer-checked:after:rotate-0">
                    </div>
                    <span class="ml-3 text-gray-700 font-medium text-sm capitalize">Primaria</span>
                </label>

                <label class="relative inline-flex items-center cursor-pointer mb-4">
                    <input type="checkbox" id="secundaria" name="secundaria" class="sr-only peer">
                    <div
                        class="group peer ring-0 bg-[#B5B4B3] rounded-full outline-none duration-300 after:duration-300 w-16 h-8 shadow-md peer-checked:bg-[#A69177] peer-focus:outline-none after:content-['✖️'] after:rounded-full after:absolute after:bg-gray-50 after:outline-none after:h-6 after:w-6 after:top-1 after:left-1 after:-rotate-180 after:flex after:justify-center after:items-center peer-checked:after:translate-x-8 peer-checked:after:content-['✔️'] peer-hover:after:scale-95 peer-checked:after:rotate-0">
                    </div>
                    <span class="ml-3 text-gray-700 font-medium text-sm capitalize">Secundaria</span>
                </label>

                <label class="relative inline-flex items-center cursor-pointer mb-4">
                    <input type="checkbox" id="preparatoria" name="preparatoria" class="sr-only peer">
                    <div
                        class="group peer ring-0 bg-[#B5B4B3] rounded-full outline-none duration-300 after:duration-300 w-16 h-8 shadow-md peer-checked:bg-[#A69177] peer-focus:outline-none after:content-['✖️'] after:rounded-full after:absolute after:bg-gray-50 after:outline-none after:h-6 after:w-6 after:top-1 after:left-1 after:-rotate-180 after:flex after:justify-center after:items-center peer-checked:after:translate-x-8 peer-checked:after:content-['✔️'] peer-hover:after:scale-95 peer-checked:after:rotate-0">
                    </div>
                    <span class="ml-3 text-gray-700 font-medium text-sm capitalize">Preparatoria</span>
                </label>

                <label class="relative inline-flex items-center cursor-pointer mb-4">
                    <input type="checkbox" id="universidad" name="universidad" class="sr-only peer">
                    <div
                        class="group peer ring-0 bg-[#B5B4B3] rounded-full outline-none duration-300 after:duration-300 w-16 h-8 shadow-md peer-checked:bg-[#A69177] peer-focus:outline-none after:content-['✖️'] after:rounded-full after:absolute after:bg-gray-50 after:outline-none after:h-6 after:w-6 after:top-1 after:left-1 after:-rotate-180 after:flex after:justify-center after:items-center peer-checked:after:translate-x-8 peer-checked:after:content-['✔️'] peer-hover:after:scale-95 peer-checked:after:rotate-0">
                    </div>
                    <span class="ml-3 text-gray-700 font-medium text-sm capitalize">Universidad</span>
                </label>
            </div>


            <div class="col-span-1">
                <label for="imagen_paquete" class="block text-gray-700 font-medium mb-2">Subir imagen del
                    paquete</label>
                <div class="flex items-center justify-center w-full">
                    <label for="imagen_paquete"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300"
                        id="drop-area">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16v-4a4 4 0 014-4h2a4 4 0 014 4v4M7 16h10M12 12h.01M12 16h.01M5 20h14a2 2 0 002-2v-4a2 2 0 00-2-2h-3l-2 2H8l-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir una
                                    imagen</span>
                                o arrastra y suelta</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, BMP, WEBP, etc. (MAX. 800x400px)</p>
                        </div>
                        <input id="imagen_paquete" name="imagen_paquete" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
                <p id="file-info" class="mt-2 text-sm text-blue-600 font-semibold transition duration-300"></p>
            </div>
        </form>

        <script>
            // Obteniendo los elementos necesarios
            const dropArea = document.getElementById('drop-area');
            const fileInput = document.getElementById('imagen_paquete');
            const fileInfo = document.getElementById('file-info');

            // Previniendo comportamientos por defecto
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Añadiendo y removiendo clases en eventos de arrastre
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('border-indigo-600'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('border-indigo-600'), false);
            });

            // Manejando el evento de soltar
            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                // Verificando si el archivo es una imagen
                if (files[0] && files[0].type.startsWith('image/')) {
                    // Asignando los archivos al input de archivo
                    fileInput.files = files;

                    // Mostrando el nombre del archivo seleccionado
                    fileInfo.textContent = `Archivo seleccionado: ${files[0].name}`;
                    fileInfo.classList.add('text-green-600');
                } else {
                    fileInfo.textContent = 'Por favor, suba solo imágenes.';
                    fileInfo.classList.add('text-red-600');
                }
            }

            // Manejando el evento de selección de archivo
            fileInput.addEventListener('change', () => {
                const files = fileInput.files;
                if (files.length > 0) {
                    if (files[0].type.startsWith('image/')) {
                        fileInfo.textContent = `Archivo seleccionado: ${files[0].name}`;
                        fileInfo.classList.add('text-green-600');
                    } else {
                        fileInfo.textContent = 'Por favor, suba solo imágenes.';
                        fileInfo.classList.add('text-red-600');
                    }
                }
            });
        </script>


        <!-- Formulario para actualizar los precios de los paquetes -->
        <form class="max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-2xl space-y-8 mt-12"
            action="{{ route('actualizarPaquetes') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                @foreach ($paquete as $p)
                    <div
                        class="col-span-1 border rounded-lg p-6 bg-white shadow-lg transition-transform transform hover:scale-105 duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <label for="paquete_{{ $p->id }}"
                                class="block text-2xl font-semibold text-gray-800">Paquete
                                {{ $p->nombre }}</label>
                            <button type="button"
                                class="py-2 px-4 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition duration-300"
                                onclick="eliminarPaquete({{ $p->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5">
                                    <path fill="white"
                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mb-4">
                            <div class="flex mb-4">
                                <span
                                    class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                                <input type="number"
                                    class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                    id="paquete_{{ $p->id }}" name="paquete_{{ $p->id }}"
                                    value="{{ $p->costo_paquete }}">
                            </div>
                        </div>
                        <!-- Botón para mostrar la imagen -->
                        <div class="flex items-center mb-4">
                            <button type="button"
                                class="py-2 px-4 bg-[#1F2937] text-white font-semibold rounded-lg shadow-lg hover:bg-gray-800 transition duration-300 mr-4"
                                onclick="mostrarImagen('{{ $p->imagen }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5">
                                    <path fill="white"
                                        d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                </svg>
                            </button>
                            <label for="imagen_paquete_{{ $p->id }}"
                                class="block text-base font-medium text-gray-800">Actualizar imagen del
                                paquete:</label>
                        </div>
                        <div class="mb-4 relative">
                            <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                id="imagen_paquete_{{ $p->id }}" name="imagen_paquete_{{ $p->id }}"
                                onchange="mostrarNombreArchivo('{{ $p->id }}')">
                            <div
                                class="w-full py-3 px-4 bg-[#1F2937] text-white font-semibold rounded-lg shadow-lg hover:bg-gray-800 transition duration-300 text-center cursor-pointer">
                                Seleccionar archivo</div>
                            <span id="nombre_archivo_{{ $p->id }}"
                                class="text-sm text-gray-600 mt-2 block"></span>
                        </div>


                        <div class="grid grid-cols-1 gap-4 mt-4">
                            <!-- Título de la sección -->
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold text-gray-800">Nivel Educativo</h3>
                                <p class="text-sm text-gray-600">Este paquete solo estará disponible para los niveles
                                    educativos que selecciones.</p>
                            </div>
                            <!-- Interruptores para niveles educativos en una fila -->
                            <div class="flex flex-wrap justify-start gap-4">
                                <div class="flex items-center space-x-2">
                                    <label for="kinder_{{ $p->id }}" class="text-base font-medium text-gray-800">
                                        Kínder
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="kinder_{{ $p->id }}"
                                            name="kinder_{{ $p->id }}" {{ $p->kinder ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="primaria_{{ $p->id }}"
                                        class="text-base font-medium text-gray-800">
                                        Primaria
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="primaria_{{ $p->id }}"
                                            name="primaria_{{ $p->id }}" {{ $p->primaria ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="secundaria_{{ $p->id }}"
                                        class="text-base font-medium text-gray-800">
                                        Secundaria
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="secundaria_{{ $p->id }}"
                                            name="secundaria_{{ $p->id }}" {{ $p->secundaria ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="preparatoria_{{ $p->id }}"
                                        class="text-base font-medium text-gray-800">
                                        Preparatoria
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="preparatoria_{{ $p->id }}"
                                            name="preparatoria_{{ $p->id }}"
                                            {{ $p->preparatoria ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="universidad_{{ $p->id }}"
                                        class="text-base font-medium text-gray-800">
                                        Universidad
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="universidad_{{ $p->id }}"
                                            name="universidad_{{ $p->id }}"
                                            {{ $p->universidad ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- CSS embebido -->
                        <style>
                            .switch {
                                position: relative;
                                display: inline-block;
                                width: 3.5em;
                                height: 1.8em;
                            }

                            .switch input {
                                opacity: 0;
                                width: 0;
                                height: 0;
                            }

                            .slider {
                                position: absolute;
                                cursor: pointer;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background-color: #cccccc;
                                transition: .4s;
                                border-radius: 1em;
                            }

                            .slider::before {
                                position: absolute;
                                content: "";
                                height: 1.6em;
                                width: 1.6em;
                                border-radius: 50%;
                                left: 0.1em;
                                bottom: 0.1em;
                                background-color: white;
                                transition: .4s;
                            }

                            input:checked+.slider {
                                background-color: #A69177;
                            }

                            input:checked+.slider::before {
                                transform: translateX(1.7em);
                            }

                            .slider:active::before {
                                width: 2.2em;
                            }
                        </style>


                        <br>


                        <!-- Título de la sección -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">Contenido del paquete</h3>
                            <p class="text-sm text-gray-600">En esta sección puedes ajustar los accesorios incluidos en el
                                paquete y personalizar los precios adicionales según tus necesidades. Asegúrate de revisar
                                cada opción para que el paquete se adapte perfectamente a tus requerimientos.</p>
                        </div>
                        <br>
                        <!-- Resto del contenido del paquete -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="col-span-1 bg-gray-200 p-4 rounded-lg">
                                <label for="incluye_individual_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mb-2">Cuadro Individual:</label>
                                <input type="number" id="incluye_individual_{{ $p->id }}"
                                    name="incluye_individual_{{ $p->id }}"
                                    class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                    value="{{ $p->incluye_individual }}">
                                <label for="costo_individual_extra_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mt-4">Costo Por Extra:</label>
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                                    <input type="number" id="costo_individual_extra_{{ $p->id }}"
                                        name="costo_individual_extra_{{ $p->id }}"
                                        class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                        value="{{ $p->costo_individual_extra }}">
                                </div>
                            </div>
                            <div class="col-span-1 bg-gray-200 p-4 rounded-lg">
                                <label for="incluye_poster_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mb-2">Foto Poster:</label>
                                <input type="number" id="incluye_poster_{{ $p->id }}"
                                    name="incluye_poster_{{ $p->id }}"
                                    class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                    value="{{ $p->incluye_poster }}">
                                <label for="costo_poster_extra_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mt-4">Costo Por Extra:</label>
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                                    <input type="number" id="costo_poster_extra_{{ $p->id }}"
                                        name="costo_poster_extra_{{ $p->id }}"
                                        class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                        value="{{ $p->costo_poster_extra }}">
                                </div>
                            </div>
                            <div class="col-span-1 bg-gray-200 p-4 rounded-lg">
                                <label for="incluye_sueltas_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mb-2">Fotos Sueltas:</label>
                                <input type="number" id="incluye_sueltas_{{ $p->id }}"
                                    name="incluye_sueltas_{{ $p->id }}"
                                    class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                    value="{{ $p->incluye_sueltas }}">
                                <label for="costo_sueltas_extra_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mt-4">Costo Por Extra:</label>
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                                    <input type="number" id="costo_sueltas_extra_{{ $p->id }}"
                                        name="costo_sueltas_extra_{{ $p->id }}"
                                        class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                        value="{{ $p->costo_sueltas_extra }}">
                                </div>
                            </div>
                            <div class="col-span-1 bg-gray-200 p-4 rounded-lg">
                                <label for="incluye_cartera_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mb-2">Fotos Cartera:</label>
                                <input type="number" id="incluye_cartera_{{ $p->id }}"
                                    name="incluye_cartera_{{ $p->id }}"
                                    class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                    value="{{ $p->incluye_cartera }}">
                                <label for="costo_cartera_extra_{{ $p->id }}"
                                    class="block text-base font-medium text-gray-800 mt-4">Costo Por Extra:</label>
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600">$</span>
                                    <input type="number" id="costo_cartera_extra_{{ $p->id }}"
                                        name="costo_cartera_extra_{{ $p->id }}"
                                        class="w-full rounded-r-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                                        value="{{ $p->costo_cartera_extra }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            document.querySelectorAll('input[type="number"]').forEach(input => {
                                input.addEventListener('input', function() {
                                    if (this.value === '') {
                                        this.value = 0;
                                    }
                                });
                            });
                        </script>


                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <button type="submit"
                    class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Modificar</button>
            </div>
        </form>

        <script>
            function mostrarImagen(imagenBase64) {
                // Decodificar la imagen base64 y mostrarla en un modal de SweetAlert2
                Swal.fire({
                    title: 'Imagen del Paquete',
                    imageUrl: 'data:image/jpeg;base64,' + imagenBase64,
                    imageAlt: 'Imagen del Paquete',
                    showCloseButton: true,
                    confirmButtonText: 'Cerrar',
                    customClass: {
                        confirmButton: 'swal2-confirm-btn'
                    }
                });
            }

            function mostrarNombreArchivo(id) {
                const input = document.getElementById(`imagen_paquete_${id}`);
                const fileName = input.files[0].name;
                const label = document.getElementById(`nombre_archivo_${id}`);
                label.textContent = `Archivo seleccionado: ${fileName}`;
            }

            // Añadir estilos personalizados a SweetAlert2
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validarFormulario() {
            var costoPaquete = document.getElementById("costo_paquete").value;
            var nombrePaquete = document.getElementById("nombre").value;

            if (nombrePaquete.trim() === "" || costoPaquete.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor complete todos los campos antes de guardar.',
                    confirmButtonColor: '#A69177'
                });
                return false;
            }

            return true;
        }

        function eliminarPaquete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A69177',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('eliminarPaquete', ['id' => '__id__']) }}'.replace('__id__', id);
                    form.style.display = 'none';

                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
