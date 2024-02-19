@extends('layouts.plantilla')

@section('titulo', 'Solicitudes')

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
        <h1 class="text-left my-4">Lista de Solicitudes de préstamo</h1>
        @if(session('mensaje'))
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <a href="{{ route('solicitudes.create') }}" class="btn btn-sm btn-success float-right">Agregar Solicitudes de préstamo</a>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Tasa de interés solicitado</th>
                <th scope="col">Tasa de interés autorizado</th>
                <th scope="col">Valor solicitado</th>
                <th scope="col">Valor autorizado</th>
                <th scope="col">Estado de solicitud</th>
                <th scope="col">Fecha de solicitud</th>
                <th scope="col">Fecha de autorizacion</th>
                <th scope="col">Fecha de desembolso</th>
                <th scope="col">Plazo</th>
                <th scope="col">Capital inicial</th>
                <th scope="col">interes inicial</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>

            <tbody class="table-group-divider">
            @foreach ($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->tasa_interes_solicitado }}</td>
                    <td>{{ $solicitud->tasa_interes_autorizado }}</td>
                    <td>{{ $solicitud->valor_solicitado }}</td>
                    <td>{{ $solicitud->valor_autorizado}}</td>
                    <td>{{ $solicitud->estado}}</td>
                    <td>{{ $solicitud->fecha_solicitud}}</td>
                    <td>{{ $solicitud->fecha_autorizacion}}</td>
                    <td>{{ $solicitud->fecha_desembolso}}</td>
                    <td>{{ $solicitud->plazo}}</td>
                    <td>{{ $solicitud->capital_inicial}}</td>
                    <td>{{ $solicitud->interes_inicial}}</td>

                    <td>
                        <div>
                            <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-outline-info bm-3">Ver</a>
                            <a href="{{ route('solicitudes.edit', $solicitud->id )}}" class="btn btn-outline-warning bm-3">Editar</a>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    {{$solicitudes->links('pagination::bootstrap-4')}}
@endsection
