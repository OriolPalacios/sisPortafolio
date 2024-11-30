<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AsignacionRevisionController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Middleware\NotRoleUser;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\SemestreController;
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

Route::get('/Administrador/docentes', [DocenteController::class, 'index'])->name('admin.docentes');
Route::get('/Administrador/docentes/{id}/editar', [DocenteController::class, 'edit'])->name('docentes.edit');
Route::post('/Administrador/docentes/{id}/actualizar', [DocenteController::class, 'update'])->name('docentes.update');

Route::get('/Administrador/revisores', function () {
    return view('administrador.revisores');
})->name('admin.revisores');


Route::get('/Administrador/semestre', [SemestreController::class, 'index'])->name('admin.semestre');
Route::get('/Administrador/semestre/formulario', [SemestreController::class, 'formulario'])->name('admin.semestre.formulario');
Route::post('/Administrador/semestre/guardar', [SemestreController::class, 'guardar'])->name('admin.semestre.guardar');

Route::get('/Administrador/semestre/{id}/edit', [SemestreController::class, 'edit'])->name('admin.semestre.edit');
Route::put('/Administrador/semestre/{id}', [SemestreController::class, 'update'])->name('admin.semestre.update');


Route::get('/Administrador/reportegeneral', function () {
    return view('administrador.reportegeneral');
})->name('admin.reportegeneral');

Route::get('/Administrador/reportehistorico', function () {
    return view('administrador.reportehistorico');
})->name('admin.reportehistorico');

Route::get('/Docente', function () {
    return view('docente.main');
})
    ->middleware('auth')
    ->middleware(NotRoleUser::class . ':Docente')
    ->name('Docente');

Route::get('/Revisor', [AsignacionRevisionController::class, 'showRevisorMain'])
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
