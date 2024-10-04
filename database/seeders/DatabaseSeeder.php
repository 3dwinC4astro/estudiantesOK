<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash; 
use App\Models\User; // Asegúrate de incluir el modelo User

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Admin', // Nombre del usuario
            'email' => 'admin@example.com', // Correo electrónico del usuario
            'password' => Hash::make('12345678'), // Contraseña encriptada
 
        ]);



        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $docente = Role::create(['name' => 'docente']);
        $director = Role::create(['name' => 'director']);

        // Crear permisos
        $permissions = [
            'add estudiantes',
            'edit estudiantes',
            'delete estudiantes',
            'view estudiantes',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos a roles
        $admin->givePermissionTo($permissions); // El admin tiene todos los permisos
        $docente->givePermissionTo(['add estudiantes', 'edit estudiantes']); // Docente puede agregar y editar
        $director->givePermissionTo('view estudiantes'); // Director solo puede ver
    }
}
