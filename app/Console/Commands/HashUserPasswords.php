<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\USUARIO;

class HashUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash all plaintext passwords';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Usuario::where('contrasena', 'password')->get();
        foreach ($users as $user) {
            $user->contrasena = Hash::make('password');
            $user->save();
        }
        $this->info('Passwords hashed successfully!');
    }
}
