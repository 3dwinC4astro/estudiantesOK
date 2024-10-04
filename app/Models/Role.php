<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define el nombre de la tabla si es diferente del nombre plural del modelo
    protected $table = 'roles'; // Asegúrate de que esto coincida con el nombre de tu tabla

    // Define los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'name',
        'guard_name',
        // Si usas el equipo, también puedes agregar el foreign key aquí
        'team_foreign_key',
    ];

    // Si es necesario, puedes definir relaciones aquí
    public function users()
    {
        return $this->belongsToMany(User::class); // Asumiendo que tienes un modelo User
    }
}
