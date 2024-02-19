
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos de empleado</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body{
            background-color: #4CAF50;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        @media print {
            .table, .table__body {
                overflow: visible;
                height: auto !important;
                width: auto !important;
            }
        }

        /*@page {
            size: landscape;
            margin: 0;
        }*/

        body {
            min-height: 100vh;
            background-color: #dee2de;
            flex-direction: column;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main.table {
            width: 82vw;
            height: 90vh;
            background-color: #fff5;
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;
            overflow: hidden;
        }

        .table__header {
            width: 100%;
            height: 10%;
            background-color: #fff4;
            padding: .8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table__header .input-group {
            width: 35%;
            height: 100%;
            background-color: #fff5;
            padding: 0 .8rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: .2s;
        }

        .table__header .input-group:hover {
            width: 45%;
            background-color: #fff8;
            box-shadow: 0 .1rem .4rem #0002;
        }

        .table__header .input-group img {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 100%;
            padding: 0 .5rem 0 .3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .table__body {
            width: 95%;
            max-height: calc(89% - 1.6rem);
            background-color: #fffb;
            margin: .8rem auto;
            border-radius: .6rem;
            overflow: auto;

        }

        img {
            border-radius:15px 15px 15px 15px;

        }


        .table__body::-webkit-scrollbar{
            width: 0.5rem;
            height: 0.5rem;
        }

        .table__body::-webkit-scrollbar-thumb{
            border-radius: .5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table__body:hover::-webkit-scrollbar-thumb{
            visibility: visible;
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

        table {
            width: 100%;
        }

        td img {
            width: 36px;
            height: 36px;
            margin-right: .5rem;
            border-radius: 50%;
            vertical-align: middle;
        }

        table, th, td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            cursor: pointer;
            text-transform: capitalize;
        }

        tbody tr:nth-child(even) {
            background-color: #0000000b;
        }

        tbody tr {
            --delay: .1s;
            transition: .5s ease-in-out var(--delay), background-color 0s;
        }

        tbody tr.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        tbody tr:hover {
            background-color: #fff6 !important;
        }

        tbody tr td,
        tbody tr td p,
        tbody tr td img {
            transition: .2s ease-in-out;
        }

        tbody tr.hide td,
        tbody tr.hide td p {
            padding: 0;
            transition: .2s ease-in-out .5s;
        }

        tbody tr.hide td img {
            width: 0;
            height: 0;
            transition: .2s ease-in-out .5s;
        }

        @media (max-width: 1000px) {
            td:not(:first-of-type) {
                min-width: 12.1rem;
            }
        }

        thead th span.icon-arrow {
            display: inline-block;
            width: 1.3rem;
            height: 1.3rem;
            border-radius: 50%;
            border: 1.4px solid transparent;

            text-align: center;
            font-size: 1rem;

            margin-left: .5rem;
            transition: .2s ease-in-out;
        }

        thead th:hover span.icon-arrow{
            border: 1.4px solid #6c00bd;
        }

        thead th:hover {
            color: #6baf79;
        }

        thead th.active span.icon-arrow{
            background-color: #6c00bd;
            color: #6baf79;
        }

        thead th.asc span.icon-arrow{
            transform: rotate(180deg);
        }

        thead th.active,tbody td.active {
            color: #6baf79;
        }

        .image {
            position: absolute;
            right: 0;
            width: 12rem;
            border-radius: .5rem;
            overflow: hidden;
            text-align: center;
            opacity: 0;
            transform: scale(.8);
            transform-origin: top right;
            box-shadow: 0 .2rem .5rem #0004;
            transition: .2s;
        }

        button {
            border: 10px;
            width: 15%;
            height: 40px;
            border-radius: 40px;
            background-color: rgb(255, 255,255, 1);
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.4s ease;
        }

        button.activo {
            background-color: #00cc99; /* verde para estado activo */
            color: #ffffff;
        }

        button.inactivo {
            background-color: #ff9933; /* naranja para estado inactivo */
            color: #ffffff;
        }

        button.suspendido {
            background-color: #ff5050; /* rojo para estado suspendido */
            color: #ffffff;
        }

        thead.activo {
            background-color: #00cc99; /* verde para estado activo */
            color: #ffffff;
        }

        thead.inactivo {
            background-color: #ff9933; /* naranja para estado inactivo */
            color: #ffffff;
        }

        thead.suspendido {
            background-color: #ff5050; /* rojo para estado suspendido */
            color: #ffffff;
        }

        .btn-cancelar {
            width: 15%;
            height: 40px;
            border-radius: 40px;
            background-color: rgb(255, 255, 255, 1);
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.4s ease;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            line-height: 40px;
            margin-top: 1rem;
        }

        .btn-cancelar:hover {
            background-color: rgb(255, 255, 255, 0.5);
        }

        .btn-cancelar.activo {
            background-color: #00cc99; /* verde para estado activo */
            color: #ffffff;
        }

        .btn-cancelar.inactivo {
            background-color: #ff9933; /* naranja para estado inactivo */
            color: #ffffff;
        }

        .btn-cancelar.suspendido {
            background-color: #ff5050; /* rojo para estado suspendido */
            color: #ffffff;
        }



    </style>

</head>

<body>
<main class="table" id="datos_del_empleado">
    <section class="table__header">
        <h1>Datos del empleado</h1>

    </section>
    <section class="table__body">
        <img src="{{ asset($empleado->foto_perfil) }}" width="200px" style="margin-left: 10px; margin-bottom: 10px; margin-top: 10px; border: 1px solid black">
        <table>
            <thead class="{{ strtolower($empleado->estado) }}">
            <tr>
                <th> Estado: </th>
                <th colspan="3"> {{ $empleado->estado }} </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> <strong>Nombres: </strong> </td>
                <td> {{ $empleado->nombres }}</td>
                <td> <strong>Apellidos: </strong> </td>
                <td> {{ $empleado->apellidos }} </td>
            </tr>
            <tr>
                <td><strong>Fecha de nacimiento: </strong></td>
                <td>{{ $empleado->fecha_nacimiento }} </td>
                <td><strong>Número de identidad(DNI): </strong></td>
                <td>{{ $empleado->identidad }} </td>
            </tr>
            <tr>
                <td><strong>Teléfono: </strong></td>
                <td> {{ $empleado->telefono }} </td>
                <td><strong>Género: </strong> </td>
                <td> {{ $empleado->genero }} </td>
            </tr>
            <tr>
                <td> <strong>Correo electrónico: </strong></td>
                <td> {{ $empleado->correo_electronico }} </td>
                <td> <strong>Estado civil: </strong> </td>
                <td> {{ $empleado->estado_civil }} </td>
            </tr>
            <tr>
                <td> <strong> Dirección: </strong> </td>
                <td> {{ $empleado->direccion }} </td>
                <td> <strong>Fecha de contratación: </strong></td>
                <td> </strong> {{ $empleado->fecha_contratacion }} </td>
            </tr>
            <tr>
                <td > <strong> Notas: </strong> </td>
                <td> {{ $empleado->notas }} <p></p> </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            </tbody>
        </table>
    </section>
</main>
<a href="{{ route('empleados.index') }}" class="btn-cancelar {{ strtolower($empleado->estado) }}" style="float: right">Regresar</a>
<script src="script.js"></script>
</body>

</html>
