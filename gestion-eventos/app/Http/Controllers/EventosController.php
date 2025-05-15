<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento; // Modelo de Evento

class EventosController extends Controller
{
    // Mostrar lista de eventos
    public function index()
    {
        $eventos = Evento::all(); // Obtener todos los eventos
        return view('eventos.index', compact('eventos')); // Pasar datos a la vista
    }

    // Mostrar detalles de un evento
    public function show($id)
    {
        $evento = Evento::findOrFail($id); // Buscar evento por ID
        return view('eventos.show', compact('evento')); // Pasar datos a la vista
    }
}