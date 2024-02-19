<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Rules\EdadCliente;
use App\Rules\DniCliente;
use App\Rules\TelefonoCliente;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $busqueda = $request->input('busqueda');
        $tipo = $request->input('tipo_filtro');

        $clientes = Cliente::query();

        if ($busqueda && $tipo) {
            if ($tipo == 'nombres') {
                $clientes->where('nombres', 'LIKE', '%' . $busqueda . '%');
            } elseif ($tipo == 'apellidos') {
                $clientes->where('apellidos', 'LIKE', '%' . $busqueda . '%');
            } elseif ($tipo == 'identidad') {
                $clientes->where('identidad', 'LIKE', '%'. $busqueda . '%');
            }
            elseif ($tipo == 'estado'){
                $clientes->where('estado', 'LIKE', '%'. $busqueda . '%');
            }
        }

        $clientes = $clientes->paginate(10)->appends(request()->query());
        return view('clientes.index', compact('clientes'));//

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.formulario'); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => ['required','regex:/[A-Za-z áéíóúñ]+$/i','max:50'],
            'apellidos' => ['required','regex:/[A-Za-z áéíóúñ]+$/i','max:50'],
            'identidad' => ['required','numeric','digits:13','unique:clientes,identidad'],new DniCliente,
            'telefono' => ['required','numeric','digits:8','unique:clientes,telefono'], new TelefonoCliente,
            'genero' => 'required',
            'estadoCivil' => 'required',
            'ocupacion' => 'required',
            'empresa' => 'required',
            'ciudad' => ['required','max:50'],
            'estado' => 'required',
            'foto' => ['required', 'image', 'max:4048'],
            'notas' => ['nullable'],
            'direccion' => ['required','max:150'],
            'fecha' => ['required','date',new EdadCliente],
        ],[
       'nombres.required'=>'El campo de nombres es obligatorio.',
       'nombres.regex'=>'Los nombres solo pueden contener letras y espacios.',
       'apellidos.required'=>'El campo de apellidos es obligatorio.',
       'apellidos.regex'=>'Los apellidos solo pueden contener letras y espacios.',
       'identidad.required'=>'El campo de Dni es obligatorio.',
       'identidad.numeric'=>'El Dni solo puede contener números.',
       'identidad.unique'=>'El Dni debe ser único.',
       'identidad.digits'=>'El DNI debe contener exactemente 13 digítos.',
       'telefono.required'=>'El campo de teléfono es obligatorio.',
       'telefono.numeric'=>'El número de teléfono solo puede contener números.',
       'telefono.digits'=>'El número de telefono soló puede tener 8 dígitos exactos.',
       'telefono.unique'=>'El número de teléfono debe de ser único.',
       'genero.required'=>'El campo de genero es obligatorio.',
       'estadoCivil.required'=>'El campo del estado civil es obligatorio.',
       'ocupacion.required'=>'El campo de la ocupación es obligatorio.',
       'empresa.required'=>'El campo de la empresa es obligatorio.',
       'ciudad.required'=>'El campo de la ciudad es obligatorio.',
        'ciudad.digits'=>'El campo de ciudad solo pude contener 250 caracteres.',
       'estado.required'=>'El campo de estado es obligatorio.',
       'direccion.required'=>'El campo de dirección es obligatorio.',
       'fecha.required'=>'El campo de fecha de nacimiento es obligatorio.',
       'foto.required' => 'La foto es obligatoria.',
       'foto.image' => 'La foto debe ser una imagen.',
       'foto.mimes' => 'El formato de la imagen no es válido.',
       'notas.regex' => 'El formato del campo notas no es válido. Solo se permiten letras y espacios.',

        ]);

        $nuevoCliente = new Cliente();
        if ($request->hasFile('foto')) {
            $imagen = $request->file('foto');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            $imagen->storeAs('public/images', $nombreImagen);

            $nuevoCliente->foto_perfil = 'storage/images/' . $nombreImagen;
        }

        $nuevoCliente = new Cliente();
        $nuevoCliente->nombres = $request->input('nombres');
        $nuevoCliente->apellidos = $request->input('apellidos');
        $nuevoCliente->identidad = $request->input('identidad');
        $nuevoCliente->telefono = $request->input('telefono');
        $nuevoCliente->genero = $request->input('genero');
        $nuevoCliente->estado_civil = $request->input('estadoCivil');
        $nuevoCliente->ocupacion = $request->input('ocupacion');
        $nuevoCliente->empresa = $request->input('empresa');
        $nuevoCliente->ciudad = $request->input('ciudad');
        $nuevoCliente->estado = $request->input('estado');
        $nuevoCliente->foto_perfil = $request->input('foto');
        $nuevoCliente->notas = $request->input('notas');
        $nuevoCliente->direccion = $request->input('direccion');
        $nuevoCliente->fecha_nacimiento = $request->input('fecha');

        if ($request->hasFile('foto')) {
            $imagen = $request->file('foto');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/images', $nombreImagen);
            $nuevoCliente->foto_perfil = 'storage/images/' . $nombreImagen; // Asignar la ruta completa
        }
        $nuevoCliente->estado = $request->input('estado');
        $nuevoCliente->notas = $request->input('notas');

        if($nuevoCliente->save()) {
            return redirect()->route('clientes.index')->with('mensaje', 'Cliente guardado exitosamente.');
        } else {
            return redirect()->route('clientes.index')->with('mensaje', 'Error. El cliente no pudo guardarse.');
        }
    }


    /**
     * Display the specified resource.
     */

   /* public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show')->with('cliente', $cliente);//


    }*/

    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show')->with('cliente', $cliente);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.formulario')->with('cliente', $cliente); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombres' => ['required','regex:/[A-Za-z áéíóúñ]+$/i','max:50'],
            'apellidos' => ['required','regex:/[A-Za-z áéíóúñ]+$/i','max:50'],
            'identidad' => ['required','numeric','digits:13',
                Rule::unique('clientes')->ignore($cliente->id)],new DniCliente,
            'telefono' => ['required','numeric','digits:8',
                Rule::unique('clientes')->ignore($cliente->id)], new TelefonoCliente,
            'genero' => 'required',
            'estadoCivil' => 'required',
            'ocupacion' => 'required',
            'empresa' => 'required',
            'ciudad' => ['required','max:50'],
            'estado' => 'required',
            'foto_perfil' => 'nullable',
            'notas' => ['nullable'],
            'direccion' => ['required','max:150'],
            'fecha' => ['required','date',new EdadCliente],
        ],[
            'nombres.required'=>'El campo de nombres es obligatorio.',
            'nombres.regex'=>'Los nombres solo pueden contener letras y espacios.',
            'apellidos.required'=>'El campo de apellidos es obligatorio.',
            'apellidos.regex'=>'Los apellidos solo pueden contener letras y espacios.',
            'identidad.required'=>'El campo de Dni es obligatorio.',
            'identidad.numeric'=>'El Dni solo puede contener números.',
            'identidad.unique'=>'El Dni debe ser único.',
            'identidad.digits'=>'El DNI debe contener exactemente 13 digítos.',
            'telefono.required'=>'El campo de teléfono es obligatorio.',
            'telefono.numeric'=>'El número de teléfono solo puede contener números.',
            'telefono.digits'=>'El número de telefono soló puede tener 8 dígitos exactos.',
            'telefono.unique'=>'El número de teléfono debe de ser único.',
            'genero.required'=>'El campo de genero es obligatorio.',
            'estadoCivil.required'=>'El campo del estado civil es obligatorio.',
            'ocupacion.required'=>'El campo de la ocupación es obligatorio.',
            'empresa.required'=>'El campo de la empresa es obligatorio.',
            'ciudad.required'=>'El campo de la ciudad es obligatorio.',
            'ciudad.digits'=>'El campo de ciudad solo pude contener 250 caracteres.',
            'estado.required'=>'El campo de estado es obligatorio.',
            'direccion.required'=>'El campo de direccion es obligatorio.',
            'fecha.required'=>'El campo de fecha de nacimiento es obligatorio.',
            'foto.required' => 'La foto es obligatoria.',
            'foto.image' => 'La foto debe ser una imagen.',
            'foto.mimes' => 'El formato de la imagen no es válido.',

        ]);


        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->identidad = $request->input('identidad');
        $cliente->telefono = $request->input('telefono');
        $cliente->genero = $request->input('genero');
        $cliente->estado_civil = $request->input('estadoCivil');
        $cliente->ocupacion = $request->input('ocupacion');
        $cliente->empresa = $request->input('empresa');
        $cliente->ciudad = $request->input('ciudad');
        $cliente->estado = $request->input('estado');
        //$cliente->foto_perfil = $request->input('foto');
        $cliente->notas = $request->input('notas');
        $cliente->direccion = $request->input('direccion');
        $cliente->fecha_nacimiento = $request->input('fecha');

        if($request->hasFile('foto') && $request->file('foto')->isValid()){
            $imagen = $request->file('foto');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/images', $nombreImagen);
            $cliente->foto_perfil = 'storage/images/' . $nombreImagen;
        }



        if($cliente->save()) {
            // significa que se guardó
            return redirect()->route('clientes.index')->with('mensaje', 'Cliente editado exitosamente.');
        } else {
            return redirect()->route('clientes.index')->with('mensaje', 'Error. Los cambios mo se guardaron.');
        }//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
