@extends('base')

@section('title', 'Agregar escuelas')

@section('content')
    <h1 class="text-2xl font-bold text-center" style="color: #A69177;">AGREGAR ESCUELA</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/agregar-escuela" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="nombre_escuela" class="block text-base font-medium text-gray-700">Nombre de la escuela:</label>
                <input type="text" name="nombre_escuela" id="nombre_escuela" value="{{ old('nombre_escuela') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="clave" class="block text-base font-medium text-gray-700">Clave:</label>
                <input type="text" name="clave" id="clave" value="{{ old('clave') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>

            <div>
                <label for="tipo_escuela" class="block text-base font-medium text-gray-700">Tipo de escuela:</label>
                <select name="tipo_escuela" id="tipo_escuela"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <option value="" selected>Selecciona</option>
                    <option value="Kinder" @if (old('tipo_escuela') == 'Kinder') selected @endif>Kinder</option>
                    <option value="Primaria" @if (old('tipo_escuela') == 'Primaria') selected @endif>Primaria</option>
                    <option value="Secundaria" @if (old('tipo_escuela') == 'Secundaria') selected @endif>Secundaria</option>
                    <option value="Preparatoria" @if (old('tipo_escuela') == 'Preparatoria') selected @endif>Preparatoria</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="municipio" class="block text-base font-medium text-gray-700">Municipio:</label>
                <input type="text" name="municipio" id="municipio" value="{{ old('municipio') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>

            <div>
                <label for="direccion" class="block text-base font-medium text-gray-700">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="inicio_generacion" class="block text-base font-medium text-gray-700">Generación
                    (Inicio):</label>
                <input type="text" name="inicio_generacion" id="inicio_generacion" value="{{ old('inicio_generacion') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="fin_generacion" class="block text-base font-medium text-gray-700">Generación (Fin):</label>
                <input type="text" name="fin_generacion" id="fin_generacion" value="{{ old('fin_generacion') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
            <div>
                <label for="turno" class="block text-base font-medium text-gray-700">Turno:</label>
                <select name="turno" id="turno"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
                    <option value="" selected>Seleccionar</option>
                    <option value="Matutino">Matutino (mañana)</option>
                    <option value="Vespertino">Vespertino (tarde)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_sesion" class="block text-base font-medium text-gray-700">Fecha de sesión:</label>
                <input type="date" name="fecha_sesion" id="fecha_sesion" value="{{ old('fecha_sesion') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>

            <div>
                <label for="ubicacion_sesion" class="block text-base font-medium text-gray-700">Ubicación de sesión:</label>
                <input type="text" name="ubicacion_sesion" id="ubicacion_sesion" value="{{ old('ubicacion_sesion') }}"
                    placeholder="Ingresa enlace de google maps"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_entrega" class="block text-base font-medium text-gray-700">Fecha de entrega:</label>
                <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{ old('fecha_entrega') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>

            <div>
                <label for="ubicacion_entrega" class="block text-base font-medium text-gray-700">Ubicación de
                    entrega:</label>
                <input type="text" name="ubicacion_entrega" id="ubicacion_entrega" value="{{ old('ubicacion_entrega') }}"
                    placeholder="Ingresa enlace de google maps"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#A69177] focus:border-[#A69177] p-2">
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <button type="button" onclick="window.history.back();"
                class="py-2 px-4 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">Cancelar</button>
            <button type="submit" class="py-2 px-4"
                style="background-color: #A69177; color: white; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.2s;">
                Guardar
            </button>
        </div>
    </form>
@endsection
