<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Layout principal del sistema: desde aqui se cargan los estilos globales, plugins y zonas comunes. --}}
    <title>{{ config('app.name', 'Sistema Bibliotecario PRO') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Librerias visuales base del panel administrativo. --}}
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        /* Estilos pequenos que usamos para resaltar el estado activo / inactivo en todas las tablas. */
        .status-switch {
            transform: scale(1.1);
        }
        .estado-booleano {
            font-weight: 600;
        }
        .estado-booleano.activo {
            color: #28a745;
        }
        .estado-booleano.inactivo {
            color: #dc3545;
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        @auth
            {{-- Si hay sesion iniciada, mostramos la barra superior y el menu lateral. --}}
            @include('layouts.topbar')
            @include('layouts.sidebar')
        @endauth

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    {{-- Aqui aparecen los mensajes flash de exito, error o validacion. --}}
                    @include('layouts.flash')
                    {{-- Cada vista hija inyecta aqui su contenido principal. --}}
                    @yield('content')
                </div>
            </section>
        </div>

        @auth
            {{-- El footer solo se muestra dentro del panel autenticado. --}}
            @include('layouts.footer')
        @endauth
    </div>

    {{-- Scripts base que necesita todo el sistema para interfaz, tablas y alertas. --}}
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/delete-confirm.js') }}"></script>
    <script src="{{ asset('backend/dist/js/statuschange.js') }}"></script>
    <script src="{{ asset('backend/dist/js/export-tools.js') }}"></script>
    <script>
        // Configuracion global en espanol para reutilizar DataTables en todos los modulos.
        window.dataTableEs = {
            language: {
                decimal: '',
                emptyTable: 'No hay datos disponibles en la tabla',
                info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                infoPostFix: '',
                thousands: ',',
                lengthMenu: 'Mostrar _MENU_ registros',
                loadingRecords: 'Cargando...',
                processing: 'Procesando...',
                search: 'Buscar:',
                zeroRecords: 'No se encontraron resultados',
                paginate: {
                    first: 'Primero',
                    last: 'Ultimo',
                    next: 'Siguiente',
                    previous: 'Anterior'
                },
                aria: {
                    sortAscending: ': activar para ordenar la columna de manera ascendente',
                    sortDescending: ': activar para ordenar la columna de manera descendente'
                }
            }
        };
    </script>
    @stack('scripts')
</body>
</html>
