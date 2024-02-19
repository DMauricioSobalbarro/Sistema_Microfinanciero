@extends('layouts.plantilla')

@section('titulo', 'Empleados')

<style>
    .pagination {
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 10px 15px;
        background-color: #81d4fa; /* Azul claro */
        border: 1px solid #ddd;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination a:hover,
    .pagination a:focus {
        background-color: #e9f7ff; /* Azul más claro */
    }

    .pagination .active a {
        background-color: #81d4fa;
        border-color: #007bff;
        color: #fff;
    }

    .pagination .disabled a {
        opacity: .5;
        pointer-events: none;
    }

    .status.activo {
        background-color: #00cc99;
        color: #ffffff;
        padding: .4rem 0;
        border-radius: 2rem;
        text-align: center;
    }

    .status.inactivo {
        background-color: #ff9933;
        color: #ffffff;
        padding: .4rem 0;
        border-radius: 2rem;
        text-align: center;
    }

    .status.suspendido {
        background-color: #ff5050;
        color: #ffffff;
        padding: .4rem 0;
        border-radius: 2rem;
        text-align: center;
    }

    thead {
        background-color: #4CAF50;
        color: white;
    }

    thead th {
        padding: 15px;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    tbody td {
        text-align: center;
    }
    table {
        border: 2px solid #ccc;
        border-collapse: collapse;
        width: 100%;
    }

</style>

@section('contenido')
    <div class="container">
        <h1 class="text-left my-4">Lista de empleados</h1>
        @if(session('mensaje'))
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <a href="{{ route('empleados.create') }}" class="btn btn-sm btn-success float-right">Agregar empleado</a>
                    </div>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('empleados.index') }}" id="formBusqueda">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend" style="margin-right: 15px">
                    <select class="form-select" name="tipo_filtro" onchange="desactivarFiltro(this); document.getElementById('formBusqueda').submit();" >
                        <option value="">Filtros</option>
                        <option value="identidad" {{ Request::input('tipo_filtro') == 'identidad' ? 'selected' : '' }}>DNI</option>
                        <option value="nombres" {{ Request::input('tipo_filtro') == 'nombres' ? 'selected' : '' }}>Nombres</option>
                        <option value="apellidos" {{ Request::input('tipo_filtro') == 'apellidos' ? 'selected' : '' }}>Apellidos</option>
                        <option value="estado" {{ Request::input('tipo_filtro') == 'estado' ? 'selected' : '' }}>Estado</option>
                    </select>
                </div>
                <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar empleados" value="{{ isset($_GET['busqueda']) ? $_GET['busqueda'] : old('busqueda') }}" oninput="document.getElementById('formBusqueda').submit()" autofocus {{ Request::input('tipo_filtro') == '' ? 'disabled' : '' }}>
            </div>
        </form>

        <script>
            function moveCursorToEnd(el) {
                if (el.value) {
                    el.setSelectionRange(el.value.length, el.value.length);
                }
            }

            window.onload = function() {
                var busquedaInput = document.getElementById('busqueda');
                moveCursorToEnd(busquedaInput);
            };

            function desactivarFiltro(select){
                var busca = document.getElementById("busqueda");
                if(select.value === ''){
                    busca.disabled = true;
                }
                else{
                    busca.disabled = false;
                    busca.value = '';
                }
            }
        </script>

        @if ($empleados->isEmpty())
            <div class="alert alert-warning" role="alert">
                No se encontraron resultados para la búsqueda.
            </div>
        @else
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Número de identidad</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombres }}</td>
                            <td>{{ $empleado->apellidos }}</td>
                            <td>{{ $empleado->identidad }}</td>
                            <td>{{ $empleado->correo_electronico}}</td>
                            <td>{{ $empleado->telefono}}</td>
                            <td><p class="status {{ $empleado->estado}}">{{ $empleado->estado}}</p></td>
                            <td>
                                <div>
                                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-outline-info bm-3">Detalles</a>
                                    <a href="{{ route('empleados.edit', $empleado->id )}}" class="btn btn-outline-warning bm-3">Editar</a>
                                </div>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>
                {{ $empleados->links('pagination::bootstrap-4') }}

            </div>
        @endif
    </div>


@endsection
