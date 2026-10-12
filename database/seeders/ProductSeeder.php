<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // extraer las categorias
        $categories = Category::all();
        //traer dos tipos de usuario (admin o mantenedor)para simular que llenan la tabla de productos
        $users = User::whereHas('role', function ($query){ //va a devolver los usuarios que tienen un rol de admin o mantenedor
            // filtrar los usuarios que tienen el rol de admin o mantenedor
            $query->where('name', 'Administrador') -> orWhere('name', 'Mantenedor');
        })->get();

        // traer productos
        $products = [
            ['name' => 'Laptop HP', 'description' => 'Laptop HP con 8GB de RAM y 256GB SSD', 'price' => 750.00, 'quantity' => 10],
            ['name' => 'Mouse Logitech', 'description' => 'Mouse inalámbrico Logitech con sensor óptico', 'price' => 25.00, 'quantity' => 50],
            ['name' => 'Teclado Mecánico', 'description' => 'Teclado mecánico con retroiluminación RGB', 'price' => 80.00, 'quantity' => 30],
            ['name' => 'Monitor Samsung', 'description' => 'Monitor Samsung de 27 pulgadas con resolución 4K', 'price' => 300.00, 'quantity' => 20],
            ['name' => 'Router TP-Link', 'description' => 'Router TP-Link con tecnología Wi-Fi 6', 'price' => 120.00, 'quantity' => 15],
            ['name' => 'Laptop Dell Inspiron', 'description' => 'Laptop Dell Inspiron con 16GB RAM y 512GB SSD', 'price' => 950.00, 'quantity' => 12],
            ['name' => 'Auriculares HyperX', 'description' => 'Auriculares gamer HyperX con sonido envolvente 7.1', 'price' => 70.00, 'quantity' => 40],
            ['name' => 'SSD Kingston 1TB', 'description' => 'Unidad de estado sólido Kingston de 1TB', 'price' => 110.00, 'quantity' => 25],
            ['name' => 'Tarjeta Gráfica NVIDIA RTX 3060', 'description' => 'GPU NVIDIA RTX 3060 con 12GB GDDR6', 'price' => 400.00, 'quantity' => 8],
            ['name' => 'Monitor LG UltraWide', 'description' => 'Monitor LG UltraWide de 34 pulgadas', 'price' => 450.00, 'quantity' => 10],
            ['name' => 'Switch Cisco', 'description' => 'Switch Cisco de 24 puertos Gigabit', 'price' => 600.00, 'quantity' => 5],
            ['name' => 'Memoria RAM Corsair 16GB', 'description' => 'Módulo DDR4 Corsair de 16GB 3200MHz', 'price' => 75.00, 'quantity' => 30],
            ['name' => 'Impresora HP LaserJet', 'description' => 'Impresora láser HP con conexión Wi-Fi', 'price' => 200.00, 'quantity' => 12],
            ['name' => 'Webcam Logitech C920', 'description' => 'Webcam Full HD Logitech C920 con micrófono integrado', 'price' => 90.00, 'quantity' => 20],
            ['name' => 'Access Point Ubiquiti', 'description' => 'Access Point Ubiquiti con soporte PoE', 'price' => 150.00, 'quantity' => 15],
        ];

        // asignar productos a categorias y usuarios
        foreach($products as $product){
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'category_id' => $categories->random()->id, // asignar categoria aleatoria
                'user_id' => $users->random()->id, // asignar usuario aleatorio
                'status' => 'available', // asignar estado disponible
            ]);

        }

    }
}
