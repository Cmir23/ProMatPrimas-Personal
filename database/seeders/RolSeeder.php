<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Administrador', 'descripcion' => 'Acceso completo al sistema'],
            ['nombre' => 'Agricultor', 'descripcion' => 'Puede crear y gestionar lotes'],
            ['nombre' => 'Supervisor', 'descripcion' => 'Puede supervisar y aprobar lotes'],
            ['nombre' => 'Operador', 'descripcion' => 'Solo lectura de lotes']
        ];

        foreach ($roles as $role) {
            Rol::create($role);
        }
    }
}