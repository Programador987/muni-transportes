<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empleado::factory()->count(50)->create();

                // READ - Obtener empleados
        $empleados = Empleado::all();
        dump("Total empleados:", $empleados->count());

        // UPDATE - Actualizar el primero
        $empleado = Empleado::first();
        $empleado->update(['nombre' => 'Nombre Actualizado']);
        dump("Empleado actualizado:", $empleado->nombre);

        // DELETE - Eliminar el último
        $ultimo = Empleado::latest()->first();
        $ultimo->delete();
        dump("Empleado eliminado:", $ultimo->id);
    }
}
