<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // Intenta retornar la vista 'home'
            return view('home');
        } catch (\Exception $e) {
            // Captura cualquier excepción y retorna una vista de error personalizada
            return response()->view('errors.custom', ['error' => $e->getMessage()], 500);
        }
    }
}
