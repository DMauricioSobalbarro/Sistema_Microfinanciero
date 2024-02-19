@extends('layouts.plantilla')

@section('titulo', 'Formulario de registro de cliente')

@section('contenido')

    <style>
        form #nombres,#apellidos,#identidad, #telefono,#genero,
        #estadoCivil,#ocupacion,#empresa,#ciudad,#direccion,
        #fecha,#estado,#foto,#notas{
             background-color: #dee2de;
             border-bottom: 3px solid;
             border-radius: 0px;
            border-bottom-color: #14722c;
        }

    </style>

    <link rel="stylesheet" href="RegistroClientes.css">

    <br>
<h1>{{ isset($cliente) ? 'Edición de cliente': 'Registro de cliente' }}</h1>

    <div id="linea" class="col-mb-12 bg-success"
    style="height: 3px;"
    > </div>

    <br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="formulario" class="shadow-lg  p-3 mb-5 rounded "
style="background-color: #dee2de">

<form method="POST" action="{{isset($cliente) ? route('clientes.update',$cliente->id):route('clientes.store')}}" class="row g-3 needs-validation box-shadow"

style="font-size: 18px"
      enctype="multipart/form-data" >
    @if(isset($cliente))
        @method('put')
    @endif
    @csrf

    <!-- NOMBRES -->
    <div class=" col-md-3">
        <label for="nombres" class="form-label">Nombres: </label>
        <input type="text" class="form-control" id="nombres" name="nombres" required
               value="{{isset($cliente) ? $cliente->nombres : old('nombres')}}"  >
    </div>

    <!-- APELLIDOS -->
    <div class="col-md-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos"
               value="{{isset($cliente) ? $cliente->apellidos : old('apellidos')}}" required>

    </div>

    <!--DNI -->
    <div class="col-md-3">
        <label for="identidad" class="form-label ">Dni:</label>
        <div class="input-group">
            <input type="number" class="form-control" id="identidad" name="identidad"
                   maxlength="13"   value="{{isset($cliente) ? $cliente->identidad : old('identidad')}}">
        </div>
    </div>

        <!--TELEFONO -->
        <div class="col-md-3">
        <label for="telefono" class="form-label">Telefono: </label>
        <input type="number" class="form-control" id="telefono" name="telefono"
               maxlength="8"    value="{{isset($cliente) ? $cliente->telefono : old('telefono')}}">
        </div>

    <!-- GÉNERO -->
    <div class="col-md-3">
        <label for="genero" class="form-label">Género: </label>
        <select class="form-select" name="genero" id="genero" >
            <option>{{isset($cliente) ? $cliente->genero : old('genero')}}</option>
            <option>Femenino</option>
            <option>Masculino</option>
            <option>Prefiero no decirlo</option>
        </select>
    </div>

    <!-- ESTADO CIVIL -->
    <div class="col-md-3">
        <label for="estadoCivil" class="form-label">Estado civil: </label>
        <select class="form-select" name="estadoCivil" id="estadoCivil">
            <option >{{isset($cliente) ? $cliente->estado_civil : old('estadoCivil')}}</option>
            <option>Soltero(a)</option>
            <option>Casado(a)</option>
            <option>Viudo(a)</option>

        </select>
    </div>

    <!--OCUPACIÓN -->
    <div class="col-md-3">
        <label for="ocupacion" class="form-label">Ocupación: </label>
        <input type="text" class="form-control" id="ocupacion" name="ocupacion"
               value="{{isset($cliente) ? $cliente->ocupacion : old('ocupacion')}}">

    </div>

    <!--EMPRESA -->
    <div class="col-md-3">
        <label for="empresa" class="form-label">Empresa: </label>
        <input type="text" class="form-control" id="empresa" name="empresa"
               value="{{isset($cliente) ? $cliente->empresa : old('empresa')}}" >

    </div>

    <!--CIUDAD-->
    <div class="col-md-3">
        <label for="ciudad" class="form-label">Ciudad: </label>
        <input type="text" class="form-control" id="ciudad" name="ciudad"
               value="{{isset($cliente) ? $cliente->ciudad : old('ciudad')}}" >
    </div>

    <!--DIRECCION-->
    <div class="col-md-3">
        <label for="direccion" class="form-label">Direccion: </label>
        <textarea class="form-control"  id="direccion"
                  name="direccion" wrap="soft" >
            {{isset($cliente) ? $cliente->direccion : old('direccion')}}</textarea>
    </div>

    <!--FECHA DE NACIMIENTO-->
    <div class="col-md-3">
        <label for="fecha" class="form-label">Fecha de nacimineto: </label>
        <input type="date" class="form-control" id="fecha" name="fecha"
               value="{{isset($cliente) ? $cliente->fecha_nacimiento : old('fecha')}}">
    </div>

    <!-- ESTADO-->
    <div class="col-md-3">
        <label for="estado" class="form-label">Estado: </label>
        <select class="form-select" name="estado" id="estado">
            <option>{{isset($cliente) ? $cliente->estado : old('estado')}} </option>
            <option>Activo</option>
            <option>Inactivo</option>
            <option>Suspendido</option>
        </select>
    </div>


        <!--COMENTARIOS-->
        <div class="col-md-6">
            <label for="notas">Comentarios: </label>
            <textarea class="form-control" placeholder="Deja tus comentarios" id="notas"
                      name="notas" wrap="soft" >
            {{isset($cliente) ? $cliente->notas : old('notas')}}</textarea>
        </div>

    <!--FOTO DE PERFIL-->
        <div class="col-md-6">
            <label for="foto" class="form-label">Sube una foto:</label>
            <input class="form-control form-control-lg" id="foto" name="foto" type="file">

            @if(isset($cliente) && $cliente->foto_perfil)
                <label for="foto">Foto anterior:</label> <p></p>
                <img src="{{  asset($cliente->foto_perfil)  }}" alt="Foto de perfil" style="max-width: 200px; margin-bottom: 10px; border: 1px solid black">
            @endif
        </div>

        <script>
            function validarExte(){
                var inputF = document.getElementById('foto');
                var rutaA = inputF.value;
                var extP = /(.png|.jpg|.jpeg|.PNG|.JPG|.JPEG)$/i;

                if(!extP.exec(rutaA)){
                    alert('Error: la foto no es válida.\nPosibles causas del error:\n1. La foto no es de tipo imagen. \n2. El formato de la imagen no es válido.');
                    inputF.value='';
                    return false;
                }
            }
        </script>

    <div class="col-xl-6" style="font-size: 25px;">
        <button class="btn btn-outline-success" type="submit">{{isset($cliente) ? 'Guardar cambios' : 'Guardar'}}</button>
        <a class="btn btn-outline-danger" href="{{ route('clientes.index') }}" >Cancelar</a>
    </div>

</form>

</div>

@endsection
