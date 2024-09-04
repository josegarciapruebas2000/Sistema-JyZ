@extends('base')

@section('title', 'Detalles de Escuela')

@section('content')
    <h1 class="text-2xl font-bold text-center text-[#A69177]">DETALLES DE LA ESCUELA</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('escuela.actualizar', ['id' => $detalle->id]) }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1">
                <label for="nombre_escuela" class="block text-base font-medium text-gray-700">Nombre de la escuela:</label>
                <input type="text" name="nombre_escuela" id="nombre_escuela" value="{{ $detalle->nombre }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="clave" class="block text-base font-medium text-gray-700">Clave:</label>
                <input type="text" name="clave" id="clave" value="{{ $detalle->clave }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="tipo_escuela" class="block text-base font-medium text-gray-700">Tipo de escuela:</label>
                <select name="tipo_escuela" id="tipo_escuela"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <option value="" selected>Selecciona</option>
                    <option value="Kinder" @if ($detalle->tipo == 'Kinder') selected @endif>Kinder</option>
                    <option value="Primaria" @if ($detalle->tipo == 'Primaria') selected @endif>Primaria</option>
                    <option value="Secundaria" @if ($detalle->tipo == 'Secundaria') selected @endif>Secundaria</option>
                    <option value="Preparatoria" @if ($detalle->tipo == 'Preparatoria') selected @endif>Preparatoria</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="col-span-1">
                <label for="municipio" class="block text-base font-medium text-gray-700">Municipio:</label>
                <input type="text" name="municipio" id="municipio" value="{{ $detalle->municipio }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="direccion" class="block text-base font-medium text-gray-700">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="{{ $detalle->direccion }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1">
                <label for="inicio_generacion" class="block text-base font-medium text-gray-700">Generación
                    (Inicio):</label>
                <input type="text" name="inicio_generacion" id="inicio_generacion"
                    value="{{ $detalle->inicio_generacion }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="fin_generacion" class="block text-base font-medium text-gray-700">Generación (Fin):</label>
                <input type="text" name="fin_generacion" id="fin_generacion" value="{{ $detalle->fin_generacion }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="turno" class="block text-base font-medium text-gray-700">Turno:</label>
                <select name="turno" id="turno"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <option value="" selected>Seleccionar</option>
                    <option value="Matutino" @if ($detalle->turno == 'Matutino') selected @endif>Matutino (mañana)</option>
                    <option value="Vespertino" @if ($detalle->turno == 'Vespertino') selected @endif>Vespertino (tarde)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="col-span-1">
                <label for="fecha_sesion" class="block text-base font-medium text-gray-700">Fecha de sesión:</label>
                <input type="date" name="fecha_sesion" id="fecha_sesion" value="{{ $detalle->fecha_sesion }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div class="col-span-1">
                <label for="ubicacion_sesion" class="block text-base font-medium text-gray-700">Ubicación sesión:</label>
                <div class="flex mt-1">
                    <input type="text" name="ubicacion_sesion" id="ubicacion_sesion"
                        value="{{ $detalle->ubicacion_sesion }}"
                        class="block w-full rounded-l-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <a href="{{ $detalle->ubicacion_sesion }}" target="_blank"
                        class="google-maps-button flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-6 w-6 google-maps-icon">
                            <path
                                d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152V422.8c0 9.8-6 18.6-15.1 22.3L416 503V200.4zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6V451.8L32.9 502.7C17.1 509 0 497.4 0 480.4V209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77V504.3L192 449.4V255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                        </svg>
                    </a>
                </div>
            </div>

            <style>
                .google-maps-button {
                    background-color: var(--google-maps-button-bg, #A69177);
                    color: var(--google-maps-button-color, #FFFFFF);
                    border-radius: 0 0.375rem 0.375rem 0;
                    padding-left: 1rem;
                    padding-right: 1rem;
                    height: 3rem;
                    transition: background-color 0.3s;
                }

                .google-maps-button:hover {
                    background-color: var(--google-maps-button-hover-bg, #1F2937);
                }

                .google-maps-icon {
                    fill: var(--google-maps-icon-color, #ffffff);
                }
            </style>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="col-span-1">
                <label for="fecha_entrega" class="block text-base font-medium text-gray-700">Fecha de entrega:</label>
                <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{ $detalle->fecha_entrega }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>

            <div class="col-span-1">
                <label for="ubicacion_entrega" class="block text-base font-medium text-gray-700">Ubicación
                    entrega:</label>
                <div class="flex mt-1">
                    <input type="text" name="ubicacion_entrega" id="ubicacion_entrega"
                        value="{{ $detalle->ubicacion_entrega }}"
                        class="block w-full rounded-l-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <a href="{{ $detalle->ubicacion_entrega }}" target="_blank"
                        class="google-maps-button flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-6 w-6 google-maps-icon">
                            <path
                                d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152V422.8c0 9.8-6 18.6-15.1 22.3L416 503V200.4zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6V451.8L32.9 502.7C17.1 509 0 497.4 0 480.4V209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77V504.3L192 449.4V255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <!-- <label for="url_whatsapp" class="block text-base font-medium text-gray-700">URL WhatsApp PARA PRUEBAS AL DOC:</label>
    <div class="flex space-x-4">
        <input type="text" name="url_whatsapp" id="url_whatsapp" value="/datos/{{ $detalle->id }}" readonly
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2 flex-1">
        <button type="button" id="whatsapp_button"
            class="py-2 px-4 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition duration-300">
            WhatsApp
        </button>
    </div> -->


            <label for="url_whatsapp" class="block text-base font-medium text-gray-700">URL WhatsApp:</label>
            <div class="flex space-x-4">
                <input type="text" name="url_whatsapp" id="url_whatsapp" value="/JyZ/{{ $detalle->id }}"
                    readonly
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2 flex-1">
                <button type="button" id="whatsapp_button"
                    class="py-2 px-4 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition duration-300">
                    WhatsApp
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="pack1" class="block text-base font-medium text-gray-700">Pack 1:</label>
                <input type="text" name="pack1" id="pack1" value="{{ old('pack1') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="pack2" class="block text-base font-medium text-gray-700">Pack 2:</label>
                <input type="text" name="pack2" id="pack2" value="{{ old('pack2') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="pack3" class="block text-base font-medium text-gray-700">Pack 3:</label>
                <input type="text" name="pack3" id="pack3" value="{{ old('pack3') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="pack4" class="block text-base font-medium text-gray-700">Pack 4:</label>
                <input type="text" name="pack4" id="pack4" value="{{ old('pack4') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="chicos" class="block text-base font-medium text-gray-700">Chicos:</label>
                <input type="text" name="chicos" id="chicos" value="{{ old('chicos') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="largos" class="block text-base font-medium text-gray-700">Largos:</label>
                <input type="text" name="largos" id="largos" value="{{ old('largos') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('escuelas') }}">
                <button type="button"
                    class="py-2 px-4 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">Cancelar</button>
            </a>
            <button type="submit"
                class="py-2 px-4 bg-[#A69177] text-white rounded-lg shadow transition-transform duration-200 hover:scale-105">
                Guardar
            </button>
        </div>
    </form>

    <script>
        var whatsappButton = document.getElementById("whatsapp_button");
        whatsappButton.addEventListener("click", function() {
            var urlWhatsapp = document.getElementById("url_whatsapp").value;
            window.open(urlWhatsapp, '_blank');
        });
    </script>

@endsection
