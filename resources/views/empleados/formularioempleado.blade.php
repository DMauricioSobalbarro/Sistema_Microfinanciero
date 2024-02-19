@extends('layouts.plantilla')

@section('titulo', 'Empleados')

<style>
    h1 {
        margin-bottom: 20px;
        position: relative;
    }

    h1::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: green;
    }
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
    }

    form {
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        border-radius: 20px;
        background-color: #fff;
        margin-left: 20px;
        margin-right: 20px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    label {
        color: #283629;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 5px;
        text-align: left;
    }

    .ok, .select, textarea {
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        background-color: #6baf79;
        border: 2px solid #F0FAf1;
        color: white;
        outline: none;
        width: calc(100% - 50px);
        transition: border-color 0.3s ease;
    }

    .ok:focus, .select:focus, textarea:focus {
        border-color: #51D94C;
    }

    input[type="file"] {
        padding: 17px 25px;
        border-radius: 15px;
        margin-bottom: 15px;
        background-color: #EDFFF0;
        border: 2px solid black;
        color: #283629;
        outline: none;
        width: calc(100% - 50px);
        transition: border-color 0.3s ease;
    }

    input[type="file"]:focus {
        border-color: #6baf79;
    }

    textarea {
        height: 100px;
    }

    input[type="file"] {
        background-color: transparent;
        padding: 0;
        border: black;
    }

    input[type="file"]::-webkit-file-upload-button {
        background-color: #6baf79;
        color: #FFFFFF;
        border: 0;
        border-radius: 25px;
        padding: 10px 20px;
        cursor: pointer;
        border: black;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #6baf79;
        border: black;
    }

    ::placeholder,
    textarea::placeholder {
        color: #b5cab6;
    }

    .btn-primary {
        font-size: 16px;
        padding: 7px;
        color: #FFFFFF;
        border: 0;
        border-radius: 8px;
        background-color: #51D94C;
        box-shadow: 0 0 20px rgba(25, 254, 0, 0.4);
        cursor: pointer;
    }
    .btn-primary :hover {
        background-color: #50E04B;
    }

</style>

@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p></p>
    <form method='POST' action="{{ isset($empleado)? route('empleados.update', $empleado->id) : route('empleados.store')}}" enctype="multipart/form-data">
        @if(isset($empleado))
            @method('put')
        @endif
        @csrf
        <h1 style="margin-bottom: 25px">{{isset($empleado) ? 'Editar empleado' : 'Nuevo empleado'}}</h1>
        <div>
            <div class="input-group">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="nombres">Ingrese los nombres:</label>
                        <input type="text" class="ok" id="nombres" name="nombres" value="{{isset($empleado) ? $empleado->nombres : old('nombres')}}">
                    </div>
                    <div class="col-4">
                        <label for="apellidos">Ingrese los apellidos:</label>
                        <input type="text" class="ok" id="apellidos" name="apellidos" value="{{isset($empleado) ? $empleado->apellidos : old('apellidos')}}">
                    </div>
                    <div class="col-4">
                        <label for="correo">Ingrese el número de identidad:</label>
                        <input type="text" class="ok" id="identidad" name="identidad" value="{{isset($empleado) ? $empleado->identidad : old('identidad')}}" maxlength="13">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="telefono">Ingrese el teléfono:</label>
                        <input type="text" class="ok" id="telefono" name="telefono" value="{{isset($empleado) ? $empleado->telefono : old('telefono')}}" maxlength="8">
                    </div>
                    <div class="col-4">
                        <label for="correo">Ingrese el correo electrónico:</label>
                        <input type="email" class="ok" id="correo" name="correo" value="{{isset($empleado) ? $empleado->correo_electronico : old('correo')}}">
                    </div>
                    <div class="col-4">
                        <label for="nacimiento">Ingrese la fecha de nacimiento:</label>
                        <input type="date" class="ok" id="nacimiento" name="nacimiento" value="{{isset($empleado) ? $empleado->fecha_nacimiento : old('nacimiento')}}" max="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="genero">Selecciona el género:</label>
                        <select class="select" id="genero" aria-label="Default select example" name="genero">
                            <option value=""></option>
                            <option value="Femenino" {{ (isset($empleado) && ($empleado->genero == 'Femenino')) || old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Masculino" {{ (isset($empleado) && ($empleado->genero == 'Masculino')) || old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Otro" {{ (isset($empleado) && ($empleado->genero == 'Otro')) || old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="civil">Selecciona el estado civil:</label>
                        <select class="select" id="civil" aria-label="Default select example" name="civil">
                            <option value=""></option>
                            <option value="Soltero(a)" {{(isset($empleado) && ($empleado->estado_civil == 'Soltero(a)')) || old('civil') == 'Soltero(a)' ? 'selected' : ''}}>Soltero(a)</option>
                            <option value="Casado(a)" {{(isset($empleado) && ($empleado->estado_civil == 'Casado(a)')) || old('civil') == 'Casado(a)' ? 'selected' : ''}}>Casado(a)</option>
                            <option value="Viudo(a)" {{(isset($empleado) && ($empleado->estado_civil == 'Viudo(a)')) || old('civil') == 'Viudo(a)' ? 'selected' : ''}}>Viudo(a)</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="contratacion">Ingrese la fecha de contratación:</label>
                        <input type="date" class="select" id="contratacion" placeholder="Ingrese su fecha de contratacion" name="contratacion" value="{{isset($empleado) ? $empleado->fecha_contratacion : old('contratacion')}}" max="{{ date('Y-m-d') }}" min="2022-07-09">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <label for="direccion">Ingrese la dirección</label>
                        <textarea class="control" id="direccion" name="direccion">{{ isset($empleado) ? $empleado->direccion : old('direccion') }}</textarea>
                    </div>
                    <div class="col-4">
                        <label for="notas">Agregue una nota</label>
                        <textarea class="control" id="notas" name="notas">{{ isset($empleado) ? $empleado->notas : old('notas') }}</textarea>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-4">
                        <label for="estado">Selecciona el estado del empleado:</label>
                        <select class="select" id="estado" aria-label="Default select example" name="estado">
                            <option value=""></option>
                            <option value="Activo" {{ (isset($empleado) && $empleado->estado == 'Activo') || old('estado') === 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ (isset($empleado) && $empleado->estado == 'Inactivo') || old('estado') === 'Inactivo' ? 'selected' : ''  }}>Inactivo</option>
                            <option value="Suspendido" {{ (isset($empleado) && $empleado->estado == 'Suspendido') || old('estado') === 'Suspendido' ? 'selected' : ''  }}>Suspendido</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="foto">Agregue la foto del empleado:</label>
                        <input type="file" class="form-select" id="foto" name="foto" onchange="return validarExte()">
                        @if(isset($empleado) && $empleado->foto_perfil)
                            <label for="estado">Foto anterior:</label> <p></p>
                            <img src="{{  asset($empleado->foto_perfil)  }}" alt="Foto de perfil" style="max-width: 200px; margin-bottom: 10px; border: 1px solid black">
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
                </div>
            </div>
            <div>
                <button type="submit" class="btn-primary">{{isset($empleado) ? 'Actualizar' : 'Guardar'}}</button>
                <a href="{{ route('empleados.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>

@endsection
