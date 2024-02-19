@extends('layouts.plantilla')

@section('titulo', 'Formulario de registro de solicitudes de préstamo')

@section('contenido')

    <style>
        form #tasa_interes_solicitado,#tasa_interes_autorizado,#valor_solicitado, #valor_autorizado,#fecha_solicitud,
        #fecha_autorizacion,#fecha_desembolso,#plazo,#interes_inicial,
        #capital_inicial,#estado, #identidadC, #identidadE{
            background-color: #F5F5F5;
            border: 1px solid #4CAF50;
            border-radius: 10px;
            color: #333;
        }

        .btn-outline-success{
            background-color: #4CAF50;
            color: #FFF;
            border: 1px solid #4CAF50;
        }
        .btn-outline-danger{
            background-color: #FF6347;
            color: #FFF;
            border: 1px solid #FF6347;

            label {
                color: #28362e;
                font-size: 15px;
                font-weight: 600;
                margin-bottom: 5px;
                text-align: left;
            }

            body{

                background-color: #9ca3af;
            }

            container{
                background-color: #9ca3af;

            }

        }
    </style>

    <br>
    <h1>{{ isset($solicitud) ? 'Edición de solicitudes de préstamo': 'Registro de solicitudes de préstamo' }}</h1>

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

        <form method="POST" action="{{isset($solicitud) ? route('solicitudes.update',$solicitud->id):route('solicitudes.store')}}" class="row g-3 needs-validation box-shadow"

              style="font-size: 22px"
              enctype="multipart/form-data" >
            @if(isset($solicitudes))
                @method('put')
            @endif
            @csrf

                <div class="col-md-3">
                    <label for="identidadC" class="form-label ">Ingrese el id cliente:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="identidadC" name="identidadC"
                               maxlength="13" min="0"   value="{{isset($cliente) ? $cliente->identidad : old('identidadC')}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="identidadE" class="form-label ">Ingrese el id empleado:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="identidadE" name="identidadE"
                               maxlength="13" min="0"  value="{{isset($empleado) ? $empleado->identidad : old('identidadE')}}">
                    </div>
                </div>

            <!---->
            <div class="col-md-3">
                <label for="tasa_interes_solicitado" class="form-label">Tasa de intereses solicitado:</label>
                <input type="number" class="form-control" id="tasa_interes_solicitado" name="tasa_interes_solicitado" required
                       min="0"
                       value="{{ isset($solicitud) ? $solicitud->tasa_interes_solicitado : old('tasa_interes_solicitado') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="tasa_interes_autorizado" class="form-label">Tasa de intereses autorizado:</label>
                <input type="number" class="form-control" id="tasa_interes_autorizado" name="tasa_interes_autorizado"
                       min="0"
                       value="{{ isset($solicitud) ? $solicitud->tasa_interes_autorizado : old('tasa_interes_autorizado') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="valor_solicitado" class="form-label">Valor socilicitado:</label>
                <input type="number" class="form-control" id="valor_solicitado" name="valor_solicitado" required
                       min="0" step="0.01"
                       value="{{ isset($solicitud) ? $solicitud->valor_solicitado : old('valor_solicitado') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="valor_autorizado" class="form-label">Valor autorizado:</label>
                <input type="number" class="form-control" id="valor_autorizado" name="valor_autorizado"
                       min="0" step="0.01"
                       value="{{ isset($solicitud) ? $solicitud->valor_autorizado : old('valor_autorizado') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="estado" class="form-label">Estado: </label>
                <select class="form-select" name="estado" id="estado" >
                    <option>{{isset($solicitud) ? $solicitud->estado : old('estado')}}</option>
                    <option>Borrador</option>
                    <option>Solicitud</option>
                    <option>Verificado</option>
                    <option>Autorizado</option>
                    <option>Denegado</option>
                </select>
            </div>

            <!---->
            <div class="col-md-3">
                <label for="fecha_solicitud" class="form-label">Fecha de solicitud:</label>
                <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" required
                       value="{{ isset($solicitud) ? $solicitud->fecha_solicitud : old('fecha_solicitud') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="fecha_autorizacion" class="form-label">Fecha de autorizacion:</label>
                <input type="date" class="form-control" id="fecha_autorizacion" name="fecha_autorizacion"
                       value="{{ isset($solicitud) ? $solicitud->fecha_autorizacion : old('fecha_autorizacion') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="fecha_desembolso" class="form-label">Fecha de desembolso:</label>
                <input type="date" class="form-control" id="fecha_desembolso" name="fecha_desembolso"
                       value="{{ isset($solicitud) ? $solicitud->fecha_desembolso : old('fecha_desembolso') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="plazo" class="form-label">Plazo:</label>
                <input type="text" class="form-control" id="plazo" name="plazo" required
                       value="{{ isset($solicitud) ? $solicitud->plazo : old('plazo') }}">
            </div>

                <!---->
                <div class="col-md-3">
                    <label for="tipo_prestamo" class="form-label">Tipo de préstamo: </label>
                    <select class="form-select" name="tipo_prestamo" id="tipo_prestamo" >
                        <option value=""></option>
                        <option value="Préstamo Diario" {{ (isset($solicitud) && ($solicitud->tipo_prestamo_id == 1)) || old('tipo_prestamo') == 'Préstamo Diario' ? 'selected' : '' }}>Préstamo Diario</option>
                        <option value="Préstamo Semanal" {{ (isset($solicitud) && ($solicitud->tipo_prestamo_id == 2)) || old('tipo_prestamo') == 'Préstamo Semanal' ? 'selected' : '' }}>Préstamo Semanal</option>
                        <option value="Préstamo Quincenal" {{ (isset($solicitud) && ($solicitud->tipo_prestamo_id == 3)) || old('tipo_prestamo') == 'Préstamo Quincenal' ? 'selected' : '' }}>Préstamo Quincenal</option>
                        <option value="Préstamo Mensual" {{ (isset($solicitud) && ($solicitud->tipo_prestamo_id == 4)) || old('tipo_prestamo') == 'Préstamo Mensual' ? 'selected' : '' }}>Préstamo Mensual</option>
                        (['Préstamo Diario','Préstamo Semanal', 'Préstamo Quincenal', 'Préstamo Mensual'])

                    </select>
                </div>

            <!---->
            <div class="col-md-3">
                <label for="capital_inicial" class="form-label">Capital inicial:</label>
                <input type="number" class="form-control" id="capital_inicial" name="capital_inicial" required
                       min="0" step="0.01"
                       value="{{ isset($solicitud) ? $solicitud->capital_inicial : old('capital_inicial') }}">
            </div>

            <!---->
            <div class="col-md-3">
                <label for="interes_inicial" class="form-label">Interes inicial:</label>
                <input type="number" class="form-control" id="interes_inicial" name="interes_inicial" required
                       min="0" step="0.01"
                       value="{{ isset($solicitud) ? $solicitud->interes_inicial : old('interes_inicial') }}">
            </div>

                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            <!---->
            <div class="col-xl-6" style="font-size: 25px;">
                <button class="btn btn-outline-success" type="submit">{{isset($solicitud) ? 'Guardar cambios' : 'Guardar'}}</button>
                <a class="btn btn-outline-danger" href="{{ route('solicitudes.index') }}" >Cancelar</a>
            </div>
        </form>

    </div>
@endsection
