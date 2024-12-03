<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AsignacionRevisionController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Middleware\NotRoleUser;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\EvaluacionPracticoController;
use App\Http\Controllers\EvaluacionTeoricoController;
use App\Http\Controllers\DashboardAdminController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('main');
    }
    return redirect('/login');  
})->middleware('guest');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::get('/main', function () {
    //current role of the user;
    return view('main');
})
    ->middleware('auth')
    ->middleware(RedirectBasedOnRole::class . ':Root')
    ->name('main');


Route::get('/Administrador', [DashboardAdminController::class, 'index'])
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Administrador')
    ->name('Administrador');

Route::get('/Administrador/docentes', [DocenteController::class, 'index'])->name('admin.docentes');
Route::get('/Administrador/docentes/{id}/editar', [DocenteController::class, 'edit'])->name('docentes.edit');
Route::post('/Administrador/docentes/{id}/actualizar', [DocenteController::class, 'update'])->name('docentes.update');

Route::get('/Administrador/docentes/agregar', [DocenteController::class, 'create'])->name('docentes.create');

Route::post('/Administrador/docentes/guardar', [DocenteController::class, 'store'])->name('docentes.store');


Route::get('/Administrador/revisores', [DocenteController::class, 'revisores'])->name('admin.revisores');
Route::get('/Administrador/revisores/{id}/asignar', [DocenteController::class, 'editarAsignacion'])->name('revisores.editarAsignacion');
Route::post('/Administrador/revisores/{id}/asignar', [DocenteController::class, 'actualizarAsignacion'])->name('revisores.updateAsignacion');


Route::get('/Administrador/semestre', [SemestreController::class, 'index'])->name('admin.semestre');
Route::get('/Administrador/semestre/formulario', [SemestreController::class, 'formulario'])->name('admin.semestre.formulario');
Route::post('/Administrador/semestre/guardar', [SemestreController::class, 'guardar'])->name('admin.semestre.guardar');
Route::post('/Administrador/semestre/actualizar-estados', [SemestreController::class, 'actualizarEstados'])->name('admin.semestre.actualizarEstados');


Route::get('/Administrador/semestre/{id}/edit', [SemestreController::class, 'edit'])->name('admin.semestre.edit');
Route::put('/Administrador/semestre/{id}', [SemestreController::class, 'update'])->name('admin.semestre.update');



// Agregar las rutas de reportes aquí
Route::prefix('Administrador')->middleware(['auth', NotRoleUser::class . ':Administrador'])->group(function () {
    // Rutas de reportes
    Route::get('/reportes/general', [App\Http\Controllers\Admin\ReporteController::class, 'reporteGeneral'])
        ->name('Administrador.reportes.general');
    Route::get('/reportes/general/export', [App\Http\Controllers\Admin\ReporteController::class, 'exportarReporteGeneral'])
        ->name('Administrador.reportes.general.export');
    Route::get('/reportes/docente', [App\Http\Controllers\Admin\ReporteController::class, 'reporteDocente'])
        ->name('Administrador.reportes.docente');
    Route::get('/reportes/docente/{id}/export', [App\Http\Controllers\Admin\ReporteController::class, 'exportarReporteDocente'])
        ->name('Administrador.reportes.docente.export');
});
    
Route::get('/Docente', function () {
    return view('docente.main');
})
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Docente')
    ->name('Docente');


// Rutas para el revisor
Route::get('/Revisor', [AsignacionRevisionController::class, 'showRevisorMain'])
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Revisor')
    ->name('Revisor');
// Agregar las rutas del reporte de Revisor aquí
Route::prefix('Revisor')->middleware(['auth', NotRoleUser::class . ':Revisor'])->group(function () {
    Route::get('/Portafolios', [AsignacionRevisionController::class, 'showRevisorPortafolios'])
        ->name('Revisor.portafolios');
    Route::get('/Observaciones', [AsignacionRevisionController::class, 'showRevisorPortafolios'])
        ->name('Revisor.observaciones');
    Route::get('/Reportes', [AsignacionRevisionController::class, 'showRevisorPortafolios'])
        ->name('Revisor.reportes');
});

Route::put('evaluacionPractico/{id}', [EvaluacionPracticoController::class, 'update'])
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Revisor')
    ->name('evaluacionPractico.update');

Route::put('evaluacionTeorico/{id}', [EvaluacionTeoricoController::class, 'update'])
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Revisor')
    ->name('evaluacionTeorico.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

