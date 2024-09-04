@extends('base')

@section('title', 'Lista de Escuelas')

@section('content')
    <h1 class="text-2xl md:text-3xl font-bold text-center mt-4" style="color: #A69177;">{{ $tipo }}</h1>

    <div class="flex flex-wrap justify-start items-center gap-4 px-4 mt-6">
        <div class="w-full sm:w-auto mb-3">
            <div class="flex flex-col sm:flex-row rounded-md shadow-sm">
                <label for="fin_generacion"
                    class="inline-flex items-center px-3 bg-[#1F2937] text-white font-semibold rounded-t-md sm:rounded-none sm:rounded-l-md">Generación</label>
                <input type="text"
                    class="flex-1 block w-full rounded-b-md sm:rounded-none sm:rounded-r-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-2 bg-white placeholder-gray-400"
                    id="fin_generacion" name="fin_generacion" value="{{ request('fin_generacion', $currentYear) }}">
            </div>
        </div>

        <div class="w-full sm:w-auto mb-3">
            <div class="flex rounded-md shadow-sm">
                <input type="text"
                    class="flex-1 block w-full rounded-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-2 bg-white placeholder-gray-400"
                    id="buscar" name="buscar" placeholder="Buscar escuela" value="{{ request('buscar') }}">
            </div>
        </div>

        <div class="w-full sm:w-auto mb-3">
            <div class="flex rounded-md shadow-sm">
                <select
                    class="flex-1 block w-full rounded-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-2 bg-white placeholder-gray-400"
                    id="tipo_escuela" name="tipo_escuela">
                    <option value="">Todo</option>
                    <option value="Kinder" {{ request('tipo_escuela') == 'Kinder' ? 'selected' : '' }}>Kinder</option>
                    <option value="Primaria" {{ request('tipo_escuela') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                    <option value="Secundaria" {{ request('tipo_escuela') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                    </option>
                    <option value="Preparatoria" {{ request('tipo_escuela') == 'Preparatoria' ? 'selected' : '' }}>
                        Preparatoria</option>
                    <option value="Universidad" {{ request('tipo_escuela') == 'Universidad' ? 'selected' : '' }}>
                        Universidad</option>
                </select>
            </div>
        </div>

        <div class="w-full sm:w-auto mb-3">
            <label for="fecha_sesion" class="block text-gray-700 font-semibold mb-1">Fecha de Sesión</label>
            <div class="flex rounded-md shadow-sm">
                <input type="date"
                    class="flex-1 block w-full rounded-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-2 bg-white placeholder-gray-400"
                    id="fecha_sesion" name="fecha_sesion" value="{{ request('fecha_sesion') }}">
            </div>
        </div>

        <div class="w-full sm:w-auto mb-3">
            <label for="fecha_entrega" class="block text-gray-700 font-semibold mb-1">Fecha de Entrega</label>
            <div class="flex rounded-md shadow-sm">
                <input type="date"
                    class="flex-1 block w-full rounded-md border-gray-300 focus:ring-[#A69177] focus:border-[#A69177] p-2 bg-white placeholder-gray-400"
                    id="fecha_entrega" name="fecha_entrega" value="{{ request('fecha_entrega') }}">
            </div>
        </div>

        <div class="flex space-x-2 mb-3">
            <button type="button"
                class="py-2 px-4 bg-[#1F2937] text-white rounded-lg shadow hover:bg-gray-700 transition duration-300"
                onclick="buscarEscuela()">Buscar</button>
            <button type="button"
                class="py-2 px-4 bg-red-600 text-white rounded-lg shadow hover:bg-red-500 transition duration-300"
                onclick="limpiar()">Limpiar</button>
            <button id="show-calendar"
                class="py-2 px-4 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700 transition duration-300">
                Mostrar Calendario
            </button>
        </div>
    </div>

    <script>
        function buscarEscuela() {
            var generacion = document.getElementById("fin_generacion").value;
            var buscar = document.getElementById("buscar").value;
            var tipo = document.getElementById("tipo_escuela").value;
            var fechaSesion = document.getElementById("fecha_sesion").value;
            var fechaEntrega = document.getElementById("fecha_entrega").value;

            var query = "";
            if (generacion) {
                query += "&fin_generacion=" + generacion;
            }
            if (buscar) {
                query += "&buscar=" + buscar;
            }
            if (tipo) {
                query += "&tipo_escuela=" + tipo;
            }
            if (fechaSesion) {
                query += "&fecha_sesion=" + fechaSesion;
            }
            if (fechaEntrega) {
                query += "&fecha_entrega=" + fechaEntrega;
            }

            window.location.href = "/escuelas?" + query.substring(1);
        }

        function limpiar() {
            document.getElementById("fin_generacion").value = "{{ $currentYear }}";
            document.getElementById("buscar").value = "";
            document.getElementById("tipo_escuela").value = "";
            document.getElementById("fecha_sesion").value = "";
            document.getElementById("fecha_entrega").value = "";
            window.location.href = "/escuelas";
        }
    </script>

    <div class="flex justify-end space-x-2 px-4 mt-6">
        <a href="/agregar-escuela" class="text-decoration-none">
            <button type="button"
                class="py-2 px-4 bg-[#A69177] text-white rounded-lg shadow transition duration-300 hover:bg-[#8B5D33]">Agregar
                escuela</button>
        </a>
        <a href="/elegir" class="text-decoration-none">
            <button type="button"
                class="py-2 px-4 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">Regresar</button>
        </a>
    </div>

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Tipo</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Escuela</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Turno</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Generación</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Municipio</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Fecha de Sesión</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Fecha de Entrega</th>
                    <th scope="col" class="py-2 px-4 text-xs md:text-sm">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($escuelas as $escuela)
                    @php
                        $fechaSesion = \Carbon\Carbon::parse($escuela->fecha_sesion);
                        $hoy = \Carbon\Carbon::now();
                        $rowClass =
                            $escuela->status == 1
                                ? 'status-1'
                                : ($escuela->status == 2
                                    ? 'status-2'
                                    : ($escuela->status == 0 && $hoy > $fechaSesion
                                        ? 'status-overdue'
                                        : 'status-0'));
                    @endphp
                    <tr class="text-center border-b {{ $rowClass }}">
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $escuela->tipo }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $escuela->nombre }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $escuela->turno }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $escuela->inicio_generacion }} -
                            {{ $escuela->fin_generacion }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $escuela->municipio }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">{{ $fechaSesion->format('d/m/Y') }}</td>
                        <td class="py-2 px-4 text-xs md:text-sm">
                            {{ \Carbon\Carbon::parse($escuela->fecha_entrega)->format('d/m/Y') }}</td>
                        <td class="py-2 px-4 flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2 justify-center">
                            <a href="/lista/{{ $escuela->id }}"
                                class="py-1 px-3 bg-[#A69177] text-white rounded-lg shadow transition duration-300 hover:bg-[#8B5D33] text-xs md:text-sm">Lista</a>
                            <a href="/detalles/{{ $escuela->id }}"
                                class="py-1 px-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300 text-xs md:text-sm">Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <style>
            .status-0 {
                /* Default color, no additional styles needed unless you want a specific default color */
            }

            .status-1 {
                background-color: rgba(255, 255, 0, 0.252);
            }

            .status-2 {
                background-color: rgba(0, 90, 0, 0.444);
            }

            .status-overdue {
                background-color: rgba(255, 0, 0, 0.362);
            }
        </style>
    </div>

    <div class="mt-4 px-4">
        {{ $escuelas->appends([
                'fin_generacion' => request('fin_generacion', $currentYear),
                'buscar' => request('buscar'),
                'tipo_escuela' => request('tipo_escuela'),
                'fecha_sesion' => request('fecha_sesion'),
                'fecha_entrega' => request('fecha_entrega'),
            ])->links('pagination::tailwind') }}
    </div>

    <!-- FullCalendar -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales/es.js'></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Modal de confirmación -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Listo",
                text: "{{ session('success') }}",
                icon: "success",
                customClass: {
                    confirmButton: 'swal-button'
                }
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.createElement('div');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid'],
                initialView: 'dayGridMonth',
                locale: 'es', // Configuración del idioma español
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('/calendario')
                        .then(response => response.json())
                        .then(events => successCallback(events))
                        .catch(error => failureCallback(error));
                },
                dateClick: function(info) {
                    Swal.fire({
                        title: 'Eventos del día: ' + info.dateStr,
                        html: buildEventDetails(info.events),
                        icon: 'info',
                        customClass: {
                            confirmButton: 'swal-button' // Custom class for button
                        }
                    });
                }
            });

            document.getElementById('show-calendar').addEventListener('click', function() {
                Swal.fire({
                    title: 'Calendario de Eventos',
                    html: calendarEl,
                    width: 700,
                    didOpen: () => {
                        calendar.render();
                    }
                });
            });

            function buildEventDetails(events) {
                var detailsHtml = '<ul>';
                events.forEach(event => {
                    detailsHtml += '<li>' + event.extendedProps.tipo + ': ' + event.extendedProps.nombre +
                        '</li>';
                });
                detailsHtml += '</ul>';
                return detailsHtml;
            }
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

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        .fc-button {
            background-color: #1F2937;
            color: white;
            border: 1px solid #1F2937;
        }

        .fc-button:hover {
            background-color: #003988;
            color: white;
        }

        .fc-today {
            background-color: #324960 !important;
            color: white;
        }
    </style>
@endsection
