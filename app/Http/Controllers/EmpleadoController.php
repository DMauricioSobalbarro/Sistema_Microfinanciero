<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\FechaContrato;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Rules\MayorEdad;
use App\Rules\NumeroIdentidad;
use App\Rules\NumTelefono;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Validation\Rule;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
        $tipo = $request->input('tipo_filtro');

        $empleados = Empleado::query();

        if ($busqueda && $tipo) {
            if ($tipo == 'nombres') {
                $empleados->where('nombres', 'LIKE', '%' . $busqueda . '%');
            } elseif ($tipo == 'apellidos') {
                $empleados->where('apellidos', 'LIKE', '%' . $busqueda . '%');
            } elseif ($tipo == 'identidad') {
                $empleados->where('identidad', 'LIKE', '%'. $busqueda . '%');
            }
            elseif ($tipo == 'estado'){
                $empleados->where('estado', 'LIKE', '%'. $busqueda . '%');
            }
        }

        $empleados = $empleados->paginate(10)->appends(request()->query());

        return view('empleados.indexempleado', compact('empleados'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.formularioempleado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|regex:/[A-Za-z áéíóúñ]+$/i',
            'apellidos' => 'required|regex:/[A-Za-z áéíóúñ]+$/i',
            'identidad' => ['required', 'numeric', 'digits:13', 'unique:empleados,identidad',new NumeroIdentidad],
            'telefono' => ['required', 'numeric', 'digits:8', 'unique:empleados,telefono', new NumTelefono],
            'correo' => 'required|email|unique:empleados,correo_electronico',
            'direccion' => 'required',
            'nacimiento' => ['required', new MayorEdad],
            'genero' => 'required',
            'civil' => 'required',
            'foto' => ['required', 'image', 'max:2024'],
            'estado' => 'required',
            'contratacion' => ['required', new FechaContrato],

        ], [
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.regex' => 'Los apellidos solo puede contener letras y espacios.',
            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.numeric' => 'La identidad debe ser numérica.',
            'identidad.digits' => 'La identidad debe tener exactamente 13 dígitos.',
            'identidad.unique' => 'La identidad ingresada ya pertenece a otro empleadp.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits' => 'El teléfono debe tener exactamente 8 dígitos.',
            'telefono.unique' => 'El teléfono ya pertenece a otro empleado.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo valida(Debe contener @).',
            'correo.unique' => 'El correo electrónico ingresado pertenece a otro empleado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'genero.required' => 'El género es obligatorio.',
            'civil.required' => 'El estado civil es obligatorio.',
            'foto.required' => 'La foto es obligatoria.',
            'foto.image' => 'La foto debe ser una imagen.',
            'foto.mimes' => 'El formato de la imagen no es valido.',
            'estado.required' => 'El estado es obligatorio.',
            'contratacion.required' => 'La fecha de contratación es obligatoria.',
        ]);


        $nuevoEmpleado = new Empleado();
        $nuevoEmpleado->nombres = $request->input('nombres');
        $nuevoEmpleado->apellidos = $request->input('apellidos');
        $nuevoEmpleado->identidad = $request->input('identidad');
        $nuevoEmpleado->telefono = $request->input('telefono');
        $nuevoEmpleado->correo_electronico = $request->input('correo');
        $nuevoEmpleado->direccion = $request->input('direccion');
        $nuevoEmpleado->fecha_nacimiento = $request->input('nacimiento');
        $nuevoEmpleado->genero = $request->input('genero');
        $nuevoEmpleado->estado_civil = $request->input('civil');

        if ($request->hasFile('foto')) {
            $imagen = $request->file('foto');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/images', $nombreImagen);
            $nuevoEmpleado->foto_perfil = 'storage/images/' . $nombreImagen;
        }
        $nuevoEmpleado->estado = $request->input('estado');
        $nuevoEmpleado->fecha_contratacion = $request->input('contratacion');
        $nuevoEmpleado->notas = $request->input('notas');



        if($nuevoEmpleado->save()) {
            return redirect()->route('empleados.indexempleado')->with('mensaje', 'Empleado guardado exitosamente');
        } else {
            return redirect()->route('empleados.indexempleado')->with('mensaje', 'Error. El empleado no pudo guardarse');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.showempleado')->with('empleado', $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.formularioempleado')->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'nombres' => 'required|regex:/[A-Za-z áéíóúñ]+$/i',
            'apellidos' => 'required|regex:/[A-Za-z áéíóúñ]+$/i',
            'identidad' => ['required', 'numeric', 'digits:13', Rule::unique('empleados')->ignore($empleado->id),new NumeroIdentidad],
            'telefono' => ['required', 'numeric', 'digits:8', Rule::unique('empleados')->ignore($empleado->id), new NumTelefono],
            'correo' => ['required', Rule::unique('empleados', 'correo_electronico')->ignore($empleado->id)],
            'direccion' => 'required',
            'nacimiento' => ['required', new MayorEdad],
            'genero' => 'required',
            'civil' => 'required',
            'estado' => 'required',
            'contratacion' => ['required', new FechaContrato],

        ], [
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.regex' => 'Los apellidos solo puede contener letras y espacios.',
            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.numeric' => 'La identidad debe ser numérica.',
            'identidad.digits' => 'La identidad debe tener exactamente 13 dígitos.',
            'identidad.unique' => 'La identidad ingresada ya pertenece a otro empleado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits' => 'El teléfono debe tener exactamente 8 dígitos.',
            'telefono.unique' => 'El teléfono ya pertenece a otro empleado.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo valida(Debe contener @).',
            'correo.unique' => 'El correo electrónico ingresado pertenece a otro empleado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'genero.required' => 'El género es obligatorio.',
            'civil.required' => 'El estado civil es obligatorio.',
            'foto.image' => 'La foto debe ser una imagen.',
            'foto.mimes' => 'El formato de la imagen no es valido.',
            'estado.required' => 'El estado es obligatorio.',
            'contratacion.required' => 'La fecha de contratación es obligatoria.',
        ]);

        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->identidad = $request->input('identidad');
        $empleado->telefono = $request->input('telefono');
        $empleado->correo_electronico = $request->input('correo');
        $empleado->direccion = $request->input('direccion');
        $empleado->fecha_nacimiento = $request->input('nacimiento');
        $empleado->genero = $request->input('genero');
        $empleado->estado_civil = $request->input('civil');

        if($request->hasFile('foto') && $request->file('foto')->isValid()){
            $imagen = $request->file('foto');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/images', $nombreImagen);
            $empleado->foto_perfil = 'storage/images/' . $nombreImagen;
        }


        $empleado->estado = $request->input('estado');
        $empleado->fecha_contratacion = $request->input('contratacion');
        $empleado->notas = $request->input('notas');

        if($empleado->save()) {
            return redirect()->route('empleados.indexempleado')->with('mensaje', 'Empleado actualizado exitosamente');
        } else {
            return redirect()->route('empleados.indexempleado')->with('mensaje', 'Error. El empleado no pudo actualizarse');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
