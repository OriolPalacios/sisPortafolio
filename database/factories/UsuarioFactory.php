<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\USURIO>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected static ?string $password;

    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name(),
            'apellido_paterno' => $this->faker->lastName(),
            'apellido_materno' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'correo' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'contrasena' => static::$password ??= Hash::make('password'),
            'departamento' => $this->faker->word(),
            'especialidad' => $this->faker->word(),
            'revisor_asignado' => $this->faker->randomElement([0, 1]),
            'activo' => $this->faker->randomElement([0, 1]),
            'fecha_creacion' => $this->faker->date(),
            'fecha_actualizacion' => $this->faker->date()
        ];
    }
}
