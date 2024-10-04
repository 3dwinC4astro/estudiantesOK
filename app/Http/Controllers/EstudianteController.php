<?php

namespace App\Http\Controllers;

use App\Models\Estudiante; // Asegúrate de que el modelo Estudiante esté importado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EstudianteController extends Controller
{
    public function index()
    
    {

        // Verificar si el usuario autenticado tiene algún rol
    if (Auth::user()->roles->isEmpty()) {
        return redirect()->route('home')->with('error', 'No tienes acceso a esta página: (NECESITAS UN ROL)');
    }
        // Obtener todos los estudiantes de la base de datos
        $estudiantes = Estudiante::all(); 

        // Devolver la vista con los estudiantes
        return view('estudiantes', compact('estudiantes')); // Cambié la vista a 'estudiantes.index'
    }

    public function create()
    {
        // Verifica si el usuario puede agregar estudiantes
        $this->authorize('add estudiantes'); 
        return view('estudiantes.create'); // Cambié la vista a 'estudiantes.create'
    }

    public function store(Request $request)
    {
        // Verifica si el usuario puede agregar estudiantes
        $this->authorize('add estudiantes');

        // Validación de los datos del estudiante
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'celular' => 'required|string|max:15',
            'correo' => 'required|email|max:255|unique:estudiantes',
            'programa' => 'required|string|max:255',
            'semestre' => 'required|integer',
        ]);

        // Crear un nuevo estudiante
        Estudiante::create($request->all());

        return redirect()->route('estudiantes')->with('success', 'Estudiante agregado exitosamente.');
    }

    public function edit(Estudiante $estudiante)
    {
        // Verifica si el usuario puede editar estudiantes
        $this->authorize('edit estudiantes'); 
        return view('estudiantes.edit', compact('estudiante')); // Cambié la vista a 'estudiantes.edit'
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        // Verifica si el usuario puede editar estudiantes
        $this->authorize('edit estudiantes');

        // Validación de los datos del estudiante
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'celular' => 'required|string|max:15',
            'correo' => 'required|email|max:255|unique:estudiantes,correo,' . $estudiante->id,
            'programa' => 'required|string|max:255',
            'semestre' => 'required|integer',
        ]);

        // Actualizar el estudiante
        $estudiante->update($request->all());

        return redirect()->route('estudiantes')->with('success', 'Estudiante actualizado exitosamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        // Verifica si el usuario puede eliminar estudiantes
        $this->authorize('delete estudiantes');

        // Eliminar estudiante
        $estudiante->delete();

        return redirect()->route('estudiantes')->with('success', 'Estudiante eliminado exitosamente.'); // Cambié la ruta a 'estudiantes'
    }
}
