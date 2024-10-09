<?php

namespace App\Http\Controllers;

use App\Models\Role; // Ensure this model exists
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Método para listar todos los usuarios
    public function listUsers()
    {
        $users = User::all(); // Obtener todos los usuarios
        $roles = Role::all(); // Obtener todos los roles

        // Pasar ambas variables a la vista
        return view('home', compact('users', 'roles'));
    }

    // Método para asignar un rol
    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Validar que role_id exista en la tabla roles
        ]);

        // Encuentra al usuario
        $user = User::findOrFail($userId);

        // Verifica si el rol ya está asignado
        if ($user->roles()->where('id', $request->role_id)->exists()) {
            return redirect()->back()->with('warning', 'Este rol ya está asignado al usuario.');
        }

        // Asigna el rol al usuario
        $user->roles()->attach($request->role_id);

        return redirect()->back()->with('success', 'Rol asignado exitosamente.');
    }

    // Método para eliminar un rol
    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Validar que role_id exista en la tabla roles
        ]);

        // Encuentra al usuario y desvincula el rol
        $user = User::findOrFail($userId);
        $user->roles()->detach($request->role_id);

        return redirect()->back()->with('success', 'Rol eliminado exitosamente.');
    }

    // Método para redirigir a la página de inicio
    public function redirectToHome()
    {
        return redirect()->route('home'); // Redirigir a la ruta 'home'
    }
}
