<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//llamar al modelo rol
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            ['name' => 'Administrador', 'description' => 'Gestiona todo el sistema.'],
            ['name' => 'Vendedor', 'description' => 'Se encarga de las ventas.'],
            ['name' => 'Comprador', 'description' => 'Realiza compras en la plataforma.'],
            ['name' => 'Mantenedor', 'description' => 'Responsable del mantenimiento de datos.'],            
            ['name' => 'Analista', 'description' => 'Analiza los datos del sistema.'],            
            ['name' => 'Almacen', 'description' => 'Gestiona el inventario.'],            
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
