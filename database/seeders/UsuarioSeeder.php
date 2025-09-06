<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'nombre' => 'Administrador Sistema',
                'email' => 'admin@promatprimas.com',
                'telefono' => '123456789'
            ],
            [
                'nombre' => 'Juan Agricultor',
                'email' => 'agricultor@promatprimas.com',
                'telefono' => '987654321'
            ]
        ];

        foreach ($usuarios as $usuario) {
            Usuario::create($usuario);
        }
    }
}