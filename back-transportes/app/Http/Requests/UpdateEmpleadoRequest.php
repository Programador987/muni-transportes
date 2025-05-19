<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $empleadoId = $this->route('empleado')->id ?? null;

        return [
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:empleados,email,' . $empleadoId,
            'telefono' => 'nullable|string|max:20',
            'DNI' => 'sometimes|required|string|unique:empleados,DNI,' . $empleadoId,
        ];
    }
}
