<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    
    public function index(Request $request)
    {
        $porPagina = $request->query('per_page', 10); 
        return Empleado::paginate($porPagina);
    }
//Prueba numero 1
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:empleados',
            'telefono' => 'nullable|string',
        ]);

        $empleado = Empleado::create($validated);

        return response()->json($empleado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return response()->json($empleado);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $empleado = Empleado::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string',
            'apellido' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:empleados,email,' . $id,
            'telefono' => 'nullable|string',
        ]);

        $empleado->update($validated);

        return response()->json($empleado);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return response()->json(['mensaje' => 'Empleado eliminado']);
    }
}
