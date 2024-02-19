<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Solicitud;
use App\Models\Tipo;
use App\Rules\DniCliente;
use App\Rules\NumeroIdentidad;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $solicitudes = Solicitud::paginate(10);
        return view('solicitudes.indexsolicitud')->with('solicitudes', $solicitudes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('solicitudes.formulariosolicitud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'identidadE' => ['required', 'numeric', 'digits:13'],
            'identidadC' => ['required', 'numeric', 'digits:13'],
            'tipo_prestamo' => 'required',
            'tasa_interes_solicitado' => 'required|numeric|max:100',
            'tasa_interes_autorizado' => 'nullable|numeric|max:100',
            'valor_solicitado' => 'required|numeric|min:0',
            'valor_autorizado' => 'nullable|numeric|min:0',
            'estado' => 'required|in:Borrador,Solicitud,Verificado,Autorizado,Denegado',
            'fecha_solicitud' => 'required|date',
            'fecha_desembolso' => 'nullable|date',
            'plazo' => 'required|string',
            'capital_inicial' => 'required|numeric|min:0',
            'interes_inicial' => 'required|numeric|min:0',



        ],[
            'identidadE.required' => 'El número de identidad del empleado es obligatorio.',
            'identidadE.numeric' => 'La identidad del empleado debe ser numérica.',
            'identidadE.digits' => 'La identidad del empleado debe tener exactamente 13 dígitos.',
            'identidadC.required' => 'El número de identidad del cliente es obligatorio.',
            'identidadC.numeric' => 'La identidad del cliente debe ser numérica.',
            'tipo_prestamo.required' => 'El tipo de prestamo es requerido.',
            'identidadC.digits' => 'La identidad del cliente debe tener exactamente 13 dígitos.',
            'tasa_interes_solicitado.required' => 'La tasa de interes solicitado es obligatorio',
            'tasa_interes_solicitado.max' => 'La tasa de interes solicitado no puede ser mayor al 100%',
            'tasa_interes_solicitado.numeric' => 'La tasa de interes solicitado es numérica, no puede ser negativa',
            'tasa_interes_autorizado.numeric' => 'La tasa de interes solicitado es numérica, no puede ser negativa',
            'tasa_interes_autorizado.max' => 'La tasa de interes autorizado no puede ser mayor al 100%',
            'valor_solicitado.required' => 'El valor solicitado es obligatorio',
            'valor_solicitado.numeric' => 'El valor solicitado es numérico, no puede ser negativo',
            'valor_autorizado.numeric' => 'El valor solicitado es numérico, no puede ser negativo',
            'estado.required' => 'El estado es obligatorio',
            'fecha_solicitud.required' => 'La fecha de solicitud es obligatoria',
            'fecha_desembolso.nullable' => 'La fecha de desembolso puede ser nulla',
            'plazo.required' => 'El pazo es obligatorio',
            'plazo.string' => 'El plazo es numérico',
            'capital_inicial.required' => 'El capital es obligatorio',
            'capital_inicial.numeric' => 'El capital es numerico, no puede ser negativo',
            'interes_inicial.required' => 'El interes inicial es obligatorio',
            'interes_inicial.numeric' => 'El interes inicial es numerico, no puede ser negativo',

        ]);

        $empleado = Empleado::where('identidad', $request->input('identidadE'))->first();
        $cliente = Cliente::where('identidad', $request->input('identidadC'))->first();
        $tipo = Tipo::where('Tipo_prestamo', $request->input('tipo_prestamo'))->first();

        if ($empleado && $cliente && $tipo) {
            $nuevaSolicitud = new Solicitud();
            $nuevaSolicitud->tipo_prestamo_id = $tipo->id;
            $nuevaSolicitud->empleado_id = $empleado->id;
            $nuevaSolicitud->cliente_id = $cliente->id;
            $nuevaSolicitud -> tasa_interes_solicitado = $request->input('tasa_interes_solicitado');
            $nuevaSolicitud -> tasa_interes_solicitado = $request->input('tasa_interes_solicitado');
            $nuevaSolicitud -> tasa_interes_autorizado = $request->input('tasa_interes_autorizado');
            $nuevaSolicitud -> valor_solicitado = $request->input('valor_solicitado');
            $nuevaSolicitud -> valor_autorizado = $request->input('valor_autorizado');
            $nuevaSolicitud -> estado = $request->input('estado');
            $nuevaSolicitud -> fecha_solicitud = $request->input('fecha_solicitud');
            $nuevaSolicitud -> fecha_autorizacion = $request->input('fecha_autorizacion');
            $nuevaSolicitud -> fecha_desembolso = $request->input('fecha_desembolso');
            $nuevaSolicitud -> plazo = $request->input('plazo');
            $nuevaSolicitud -> capital_inicial = $request->input('capital_inicial');
            $nuevaSolicitud -> interes_inicial = $request->input('interes_inicial');

            if($nuevaSolicitud->save()) {
                return redirect()->route('solicitudes.index')->with('mensaje', 'Solicitud creada con exitosamente');
            } else {
                return redirect()->route('solicitudes.index')->with('mensaje', 'Error. la solicitud no pudo guardarse');
            }

        } else {
            return redirect()->back()->withInput()->withErrors(['identidadE' => 'El número de identidad del empleado no se encuentra en nuestros registros']);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
