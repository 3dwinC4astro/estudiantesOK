<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignAdminToFirstUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Busca el primer usuario
        if ($user) {
            $user->assignRole('admin'); // Asigna el rol de administrador
        }
    }
}
