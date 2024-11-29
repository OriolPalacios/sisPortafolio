<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\ASIGNACIONREVISION;
use Illuminate\Http\Request;

class AsignacionRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsignacionRevision $asignacionRevision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsignacionRevision $asignacionRevision)
    {
        //
    }

    public function showRevisorMain()
    {
        $asignaciones = AsignacionRevision::where('id_revisor_usuario', auth()->user()->id)->get();
        \Log::info("ASIGNACIONREVISIONCONTROLLER:\n".$asignaciones);
        $docentes_asginados = $asignaciones->pluck('id_docente_usuario')->unique();
        $docentes = Usuario::whereIn('id', $docentes_asginados)->get();
        return view('revisor.main', compact('asignaciones', 'docentes'));
    }
}
