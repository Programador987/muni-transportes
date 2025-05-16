<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'email', 'telefono', 'DNI'];
}
