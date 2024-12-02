<?php

namespace App\Http\Controllers;
use App\Models\Semestre;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Obtener el semestre activo
        $semestreActivo = Semestre::where('activo', true)->first();

        // Contar los docentes únicos con estado activo
        $usuariosActivos = Usuario::where('activo', true)
            ->whereHas('roles', function ($query) {
                $query->where('nombre_rol', 'docente');
            })
            ->distinct()
            ->count();

        return view('administrador.main', compact('semestreActivo', 'usuariosActivos'));
    }
}
