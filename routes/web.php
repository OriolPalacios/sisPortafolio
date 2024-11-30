<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AsignacionRevisionController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Middleware\NotRoleUser;
use App\Http\Controllers\EvaluacionPracticoController;
use App\Http\Controllers\EvaluacionTeoricoController;

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


Route::get('/Administrador', function () {
    return view('administrador.main');
})
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Administrador')
    ->name('Administrador');

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

