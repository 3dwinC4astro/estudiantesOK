<?php

namespace App\Http\Controllers;

use App\Models\Role; // Ensure this model exists
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Method to list all users
    public function listUsers()
    {
        $users = User::all(); // Get all users
        $roles = Role::all(); // Get all roles

        // Pass both variables to the view
        return view('home', compact('users', 'roles'));
    }

    // Method to assign a role
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
    

    // Method to remove a role
    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Validate role_id exists in roles table
        ]);

        // Find the user and detach the role
        $user = User::findOrFail($userId);
        $user->roles()->detach($request->role_id);

        return redirect()->back()->with('success', 'Rol eliminado exitosamente.');
    }
}
