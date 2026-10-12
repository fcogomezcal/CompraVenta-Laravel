<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // crear un usuario por rol

        $roles = Role::all();
        foreach ($roles as $role) {
            User::create([
            'name' => $role->name.' User', // Genera un nombre aleatorio
            'email' => strtolower($role->name) . '@example.com',
            'password' => Hash::make('123456'),
            'phone' =>fake()->phoneNumber(),
            'address' =>fake()->address(),
            'photo' =>fake()->imageUrl(100, 100, 'people', true), // Genera una URL de imagen aleatoria
            'role_id' => $role->id, // Asigna un role_id aleatorio de la tabla roles
            ]);
        }
    }
}
