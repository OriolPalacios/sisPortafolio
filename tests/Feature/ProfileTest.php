<?php

use App\Models\USUARIO;
// use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

test('Conexión con el modelo, tabla de USUARIO', function () {
    $user = Usuario::find(1);

    expect($user->id)->toBe(1);
});
test('Los nombres de usuario no pueden ser nulos', function () {
    $user = Usuario::find(1);

    expect($user->nombres)->not->toBeNull();
});

test('El correo no puede ser nulo', function () {
    $user = Usuario::find(1);

    expect($user->correo)->not->toBeNull();
});

test('La fecha de creación no puede ser nula', function () {
    $user = Usuario::find(1);

    expect($user->fecha_creacion)->not->toBeNull();
});

test('La fecha de actualizacion no puede ser nula', function () {
    $user = Usuario::find(1);

    expect($user->fecha_actualizacion)->not->toBeNull();
});

test('Usuario localizable por correo', function () {
    $user = Usuario::where('correo', 'EDWIN.CARRASCO@unsaac.edu.pe')->first();

    expect($user)->not->toBeNull();
});

test('Las contraseñas están hasheadas', function () {
    $user = Usuario::find(1);

    expect($user->password)->not->toBe('password');
});

test('Usuarios pueden ser eliminados', function () {
    $user = Usuario::factory()->create();
    $user->delete();

    expect($user->fresh())->toBeNull();
});
