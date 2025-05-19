<?php
namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Listar empleados (paginados)
    public function index(Request $request)
    {
        return Empleado::paginate($request->query('per_page', 50));
    }

    // Crear nuevo empleado
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados',
            'telefono' => 'nullable|string|max:20',
            'DNI' => 'required|string|unique:empleados|max:20',
        ]);

        $empleado = Empleado::create($validated);
        return response()->json($empleado, 201);
    }

    // Ver un empleado por ID
    public function show($id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return response()->json($empleado);
    }

    // Actualizar un empleado
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:empleados,email,' . $empleado->id,
            'telefono' => 'nullable|string|max:20',
            'DNI' => 'sometimes|required|string|unique:empleados,DNI,' . $empleado->id,
        ]);

        $empleado->update($validated);
        return response()->json($empleado);
    }

    // Eliminar un empleado
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->json(['message' => 'Empleado eliminado correctamente']);
    }
}
