<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Middleware\NotRoleUser;


Route::get('/', [AuthenticatedSessionController::class, 'create'])
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

Route::get('/Revisor', function () {
    return view('revisor.main');
})
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Revisor')
    ->name('Revisor');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// require __DIR__.'/roles.php';

