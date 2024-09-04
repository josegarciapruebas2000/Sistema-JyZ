@extends('base')

@section('title', 'Detalles de Paquetes')

@section('content')

    <!-- Barra de navegación mejorada -->
    <nav id="package-nav" class="w-full bg-white px-6 py-4 shadow-md sticky top-16 z-50 rounded-lg">
        <div class="flex justify-between items-center">
            <a href="{{ route('paquetes') }}">
                <button
                    class="bg-gradient-to-r from-[#A69177] to-[#8B5D33] text-white font-semibold py-2 px-6 rounded-full shadow-lg hover:from-[#8B5D33] hover:to-[#A69177] transition duration-300 ease-in-out transform hover:scale-110">
                    Regresar
                </button>
            </a>
            <div class="flex justify-center space-x-6">
                <a href="#colores"
                    class="text-gray-700 hover:text-[#A69177] font-semibold transition duration-300 ease-in-out transform hover:scale-110">Color</a>
                <a href="#modelos-marcos"
                    class="text-gray-700 hover:text-[#A69177] font-semibold transition duration-300 ease-in-out transform hover:scale-110">Marco</a>
                <a href="#modelos-cuadros-grupo"
                    class="text-gray-700 hover:text-[#A69177] font-semibold transition duration-300 ease-in-out transform hover:scale-110">Modelo
                    de Fotos</a>
            </div>
        </div>

        <!-- Título de la página -->
        <h1 class="text-2xl md:text-3xl font-bold text-center mt-6" style="color: #A69177;">MODELOS DE CUADRO GRUPAL</h1>
    </nav>




    <!-- Contenido principal de la página aquí -->
    <div class="mt-24">
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



        <div id="colores"></div>
        <br><br><br><br>

        <!-- Formulario para agregar un nuevo color -->
        <form class="bg-custom2 max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6 mt-12"
            action="{{ route('agregarColores') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center text-2xl font-bold text-gray-800">Color</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <input type="text"
                        class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                        id="nombre" name="nombre" placeholder="Añadir color" value="{{ old('nombre') }}">
                </div>
                <div class="col-span-1 text-center">
                    <button type="submit"
                        class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Agregar</button>
                </div>
            </div>
            <div class="col-span-1 mt-6">
                <label for="imagen_color" class="block text-gray-700 font-medium mb-2">Subir imagen del
                    color</label>
                <div class="flex items-center justify-center w-full">
                    <label for="imagen_color"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300"
                        id="drop-area-color">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16v-4a4 4 0 014-4h2a4 4 0 014 4v4M7 16h10M12 12h.01M12 16h.01M5 20h14a2 2 0 002-2v-4a2 2 0 00-2-2h-3l-2 2H8l-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir una
                                    imagen</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, BMP, WEBP, etc. (MAX. 800x400px)</p>
                        </div>
                        <input id="imagen_color" name="imagen_color" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
                <p id="file-info-color" class="mt-2 text-sm text-blue-600 font-semibold transition duration-300">
                </p>
            </div>
        </form>

        <script>
            // Obteniendo los elementos necesarios
            const dropAreaColor = document.getElementById('drop-area-color');
            const fileInputColor = document.getElementById('imagen_color');
            const fileInfoColor = document.getElementById('file-info-color');

            // Previniendo comportamientos por defecto
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropAreaColor.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Añadiendo y removiendo clases en eventos de arrastre
            ['dragenter', 'dragover'].forEach(eventName => {
                dropAreaColor.addEventListener(eventName, () => dropAreaColor.classList.add('border-indigo-600'),
                    false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropAreaColor.addEventListener(eventName, () => dropAreaColor.classList.remove('border-indigo-600'),
                    false);
            });

            // Manejando el evento de soltar
            dropAreaColor.addEventListener('drop', handleDropColor, false);

            function handleDropColor(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                // Verificando si el archivo es una imagen
                if (files[0] && files[0].type.startsWith('image/')) {
                    // Asignando los archivos al input de archivo
                    fileInputColor.files = files;
                    // Mostrando el nombre del archivo seleccionado
                    fileInfoColor.textContent = `Archivo seleccionado: ${files[0].name}`;
                    fileInfoColor.classList.add('text-green-600');
                } else {
                    fileInfoColor.textContent = 'Por favor, suba solo imágenes.';
                    fileInfoColor.classList.add('text-red-600');
                }
            }

            // Manejando el evento de selección de archivo
            fileInputColor.addEventListener('change', () => {
                const files = fileInputColor.files;
                if (files.length > 0) {
                    if (files[0].type.startsWith('image/')) {
                        fileInfoColor.textContent = `Archivo seleccionado: ${files[0].name}`;
                        fileInfoColor.classList.add('text-green-600');
                    } else {
                        fileInfoColor.textContent = 'Por favor, suba solo imágenes.';
                        fileInfoColor.classList.add('text-red-600');
                    }
                }
            });
        </script>


        <!-- Listado de colores -->
        <div class="bg-custom2 max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6 mt-12">
            <div class="text-center text-2xl font-bold text-gray-800 mb-6">Lista de Colores</div>
            <table class="w-full text-center border-collapse table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border-b p-4">Color</th>
                        <th class="border-b p-4">Ver Imagen</th>
                        <th class="border-b p-4">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($color as $c)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="border-b p-4">{{ $c->nombre }}</td>
                            <td class="border-b p-4">
                                <button type="button"
                                    class="py-2 px-4 bg-[#1F2937] text-white font-semibold rounded-lg shadow-lg hover:bg-gray-800 transition duration-300"
                                    onclick="verImagen('{{ $c->imagen }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5">
                                        <path fill="white"
                                            d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                    </svg>
                                </button>
                            </td>
                            <td class="border-b p-4">
                                <button type="button"
                                    class="py-2 px-4 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition duration-300"
                                    onclick="eliminarColor({{ $c->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5">
                                        <path fill="white"
                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            function verImagen(imagenBase64) {
                // Decodificar la imagen base64 y mostrarla en un modal de SweetAlert2
                Swal.fire({
                    title: 'Imagen del Color',
                    imageUrl: 'data:image/jpeg;base64,' + imagenBase64,
                    imageAlt: 'Imagen del Color',
                    showCloseButton: true,
                    confirmButtonText: 'Cerrar',
                    customClass: {
                        confirmButton: 'swal2-confirm-btn'
                    }
                });
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


        <div id="modelos-marcos"></div>
        <br><br><br><br>

        <!-- Formulario para agregar un nuevo modelo de marcos -->
        <form class="bg-custom1 max-w-5xl mx-auto p-8 rounded-xl shadow-xl space-y-6 mt-12"
            action="{{ route('agregarModelos') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center text-2xl font-bold text-gray-800">Marco</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="col-span-2">
                    <input type="text"
                        class="w-full rounded-lg border-gray-300 shadow-lg focus:ring-[#F5D9A5] focus:border-[#F5D9A5] p-3"
                        id="nombreModelo" name="nombreModelo" placeholder="Añadir modelo" value="{{ old('nombreModelo') }}">
                </div>
                <div class="col-span-1 text-center flex items-center justify-center">
                    <button type="submit"
                        class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Agregar</button>
                </div>
            </div>
            <div class="mt-6">
                <label for="imagen_modelo" class="block text-gray-700 font-medium mb-2">Subir imagen del
                    modelo</label>
                <div class="flex items-center justify-center w-full">
                    <label for="imagen_modelo"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300"
                        id="drop-area-modelo">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16v-4a4 4 0 014-4h2a4 4 0 014 4v4M7 16h10M12 12h.01M12 16h.01M5 20h14a2 2 0 002-2v-4a2 2 0 00-2-2h-3l-2 2H8l-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir una
                                    imagen</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, BMP, WEBP, etc. (MAX. 800x400px)</p>
                        </div>
                        <input id="imagen_modelo" name="imagen_modelo" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
                <p id="file-info-modelo" class="mt-2 text-sm text-blue-600 font-semibold transition duration-300">
                </p>
            </div>
        </form>

        <script>
            // Obteniendo los elementos necesarios
            const dropAreaModelo = document.getElementById('drop-area-modelo');
            const fileInputModelo = document.getElementById('imagen_modelo');
            const fileInfoModelo = document.getElementById('file-info-modelo');

            // Previniendo comportamientos por defecto
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropAreaModelo.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Añadiendo y removiendo clases en eventos de arrastre
            ['dragenter', 'dragover'].forEach(eventName => {
                dropAreaModelo.addEventListener(eventName, () => dropAreaModelo.classList.add('border-indigo-600'),
                    false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropAreaModelo.addEventListener(eventName, () => dropAreaModelo.classList.remove('border-indigo-600'),
                    false);
            });

            // Manejando el evento de soltar
            dropAreaModelo.addEventListener('drop', handleDropModelo, false);

            function handleDropModelo(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                // Verificando si el archivo es una imagen
                if (files[0] && files[0].type.startsWith('image/')) {
                    // Asignando los archivos al input de archivo
                    fileInputModelo.files = files;
                    // Mostrando el nombre del archivo seleccionado
                    fileInfoModelo.textContent = `Archivo seleccionado: ${files[0].name}`;
                    fileInfoModelo.classList.add('text-green-600');
                } else {
                    fileInfoModelo.textContent = 'Por favor, suba solo imágenes.';
                    fileInfoModelo.classList.add('text-red-600');
                }
            }

            // Manejando el evento de selección de archivo
            fileInputModelo.addEventListener('change', () => {
                const files = fileInputModelo.files;
                if (files.length > 0) {
                    if (files[0].type.startsWith('image/')) {
                        fileInfoModelo.textContent = `Archivo seleccionado: ${files[0].name}`;
                        fileInfoModelo.classList.add('text-green-600');
                    } else {
                        fileInfoModelo.textContent = 'Por favor, suba solo imágenes.';
                        fileInfoModelo.classList.add('text-red-600');
                    }
                }
            });
        </script>


        <!-- Listado de modelos de marcos -->
        <div class="bg-custom1 max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6 mt-12">
            <div class="text-center text-2xl font-bold text-gray-800 mb-6">Lista de marcos</div>
            <div class="overflow-x-auto">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b p-4">Modelo</th>
                            <th class="border-b p-4">Ver Imagen</th>
                            <th class="border-b p-4">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelo as $m)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="border-b p-4">{{ $m->nombre }}</td>
                                <td class="border-b p-4">
                                    <button type="button"
                                        class="py-2 px-4 bg-[#1F2937] text-white font-semibold rounded-lg shadow-lg hover:bg-gray-800 transition duration-300"
                                        onclick="verImagen('{{ $m->imagen }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5">
                                            <path fill="white"
                                                d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="border-b p-4">
                                    <button type="button"
                                        class="py-2 px-4 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition duration-300"
                                        onclick="eliminarModelo({{ $m->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5">
                                            <path fill="white"
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div id="modelos-cuadros-grupo"></div>
        <br><br><br><br>

        <!-- Formulario para agregar un nuevo modelo de cuadro de grupo -->
        <form class="bg-custom4 bg-gray-50 max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6 mt-12"
            action="{{ route('agregarModelosCuadrosGrupo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center text-2xl font-bold text-gray-800">Modelo de Fotos</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <input type="text"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-300 focus:border-blue-300 p-3"
                        id="nombreModelo" name="nombreModelo" placeholder="Nombre del modelo de cuadro"
                        value="{{ old('nombreModelo') }}">
                </div>
                <div class="col-span-1 text-center">
                    <button type="submit"
                        class="py-3 px-6 bg-[#A69177] text-white font-semibold rounded-lg shadow-xl hover:bg-[#8B5D33] transition duration-300">Agregar
                    </button>
                </div>
            </div>
            <div class="col-span-1 mt-6">
                <label for="imagen_modelo_foto_grupo" class="block text-gray-700 font-medium mb-2">Subir Imagen
                    del
                    Modelo</label>
                <div class="flex items-center justify-center w-full">
                    <label for="imagen_modelo_foto_grupo"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-100 hover:bg-gray-200 transition duration-300"
                        id="drop-area-modelo-foto-grupo">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16v-4a4 4 0 014-4h2a4 4 0 014 4v4M7 16h10M12 12h.01M12 16h.01M5 20h14a2 2 0 002-2v-4a2 2 0 00-2-2h-3l-2 2H8l-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haga clic para subir
                                    una
                                    imagen</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, BMP, WEBP, etc. (MAX. 800x400px)</p>
                        </div>
                        <input id="imagen_modelo_foto_grupo" name="imagen_modelo_foto_grupo" type="file"
                            class="hidden" accept="image/*">
                    </label>
                </div>
                <p id="file-info-modelo-foto-grupo"
                    class="mt-2 text-sm text-blue-600 font-semibold transition duration-300">
                </p>
            </div>
        </form>

        <script>
            // JavaScript para manejar arrastrar y soltar y selección de archivo
            const dropAreaModeloFotoGrupo = document.getElementById('drop-area-modelo-foto-grupo');
            const fileInputModeloFotoGrupo = document.getElementById('imagen_modelo_foto_grupo');
            const fileInfoModeloFotoGrupo = document.getElementById('file-info-modelo-foto-grupo');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropAreaModeloFotoGrupo.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropAreaModeloFotoGrupo.addEventListener(eventName, () => dropAreaModeloFotoGrupo.classList.add(
                    'border-blue-500'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropAreaModeloFotoGrupo.addEventListener(eventName, () => dropAreaModeloFotoGrupo.classList.remove(
                    'border-blue-500'), false);
            });

            dropAreaModeloFotoGrupo.addEventListener('drop', handleDropModeloFotoGrupo, false);

            function handleDropModeloFotoGrupo(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                handleFiles(files);
            }

            function handleFiles(files) {
                if (files.length && files[0].type.startsWith('image/')) {
                    fileInputModeloFotoGrupo.files = files;
                    fileInfoModeloFotoGrupo.textContent = `Archivo seleccionado: ${files[0].name}`;
                    fileInfoModeloFotoGrupo.classList.remove('text-red-600');
                    fileInfoModeloFotoGrupo.classList.add('text-green-600');
                } else {
                    fileInfoModeloFotoGrupo.textContent = 'Por favor, sube solo imágenes.';
                    fileInfoModeloFotoGrupo.classList.add('text-red-600');
                }
            }

            fileInputModeloFotoGrupo.addEventListener('change', () => {
                const files = fileInputModeloFotoGrupo.files;
                if (files.length && files[0].type.startsWith('image/')) {
                    fileInfoModeloFotoGrupo.textContent = `Archivo seleccionado: ${files[0].name}`;
                    fileInfoModeloFotoGrupo.classList.remove('text-red-600');
                    fileInfoModeloFotoGrupo.classList.add('text-green-600');
                } else {
                    fileInfoModeloFotoGrupo.textContent = 'Por favor, sube solo imágenes.';
                    fileInfoModeloFotoGrupo.classList.add('text-red-600');
                }
            });
        </script>


        <!-- Listado de modelos de cuadros de grupo -->
        <div class="bg-custom4 max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl space-y-6 mt-12">
            <div class="text-center text-2xl font-bold text-gray-800 mb-6">Lista de Modelos de Fotos
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b p-4">Modelo</th>
                            <th class="border-b p-4">Ver Imagen</th>
                            <th class="border-b p-4">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelosGrupos as $modeloGrupo)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="border-b p-4">{{ $modeloGrupo->nombre }}</td>
                                <td class="border-b p-4">
                                    <button type="button"
                                        class="py-2 px-4 bg-[#1F2937] text-white font-semibold rounded-lg shadow-lg hover:bg-gray-800 transition duration-300"
                                        onclick="verImagen('{{ $modeloGrupo->imagen }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5">
                                            <path fill="white"
                                                d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="border-b p-4">
                                    <button type="button"
                                        class="py-2 px-4 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition duration-300"
                                        onclick="eliminarModeloCuadrosGrupo({{ $modeloGrupo->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5">
                                            <path fill="white"
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            function verImagen(imagenBase64) {
                // Decodificar la imagen base64 y mostrarla en un modal de SweetAlert2
                Swal.fire({
                    title: 'Imagen del Modelo',
                    imageUrl: 'data:image/jpeg;base64,' + imagenBase64,
                    imageAlt: 'Imagen del Modelo',
                    showCloseButton: true,
                    confirmButtonText: 'Cerrar',
                    customClass: {
                        confirmButton: 'swal2-confirm-btn'
                    }
                });
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

            function eliminarModelo(id) {
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
                        form.action = '{{ route('eliminarModelo', ['id' => '__id__']) }}'.replace('__id__', id);
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

            function eliminarModeloCuadrosGrupo(id) {
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
                        form.action = '{{ route('eliminarModeloCuadrosGrupo', ['id' => '__id__']) }}'.replace('__id__',
                            id);
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



        <script>
            function verImagen(imagenBase64) {
                // Decodificar la imagen base64 y mostrarla en un modal de SweetAlert2
                Swal.fire({
                    title: 'Imagen del Modelo',
                    imageUrl: 'data:image/jpeg;base64,' + imagenBase64,
                    imageAlt: 'Imagen del Modelo',
                    showCloseButton: true,
                    confirmButtonText: 'Cerrar',
                    customClass: {
                        confirmButton: 'swal2-confirm-btn'
                    }
                });
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


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminarColor(id) {
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
                        form.action = '{{ route('eliminarColor', ['id' => '__id__']) }}'.replace('__id__', id);
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

        <style>
            .bg-custom1 {
                background-color: rgba(185, 201, 210, 0.87);
            }

            .bg-custom2 {
                background-color: #a6917762;
            }

            .bg-custom3 {
                background-color: #134f2c53;
            }

            .bg-custom4 {
                background-color: #b42a0053;
            }
        </style>
    </div>
@endsection
