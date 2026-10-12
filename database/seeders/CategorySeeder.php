<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops', 'description' => 'Computadoras portátiles de diferentes marcas.'],
            ['name' => 'Periféricos', 'description' => 'Teclados, mouses, auriculares y otros accesorios.'],
            ['name' => 'Componentes', 'description' => 'Piezas y componentes para computadoras.'],
            ['name' => 'Monitores', 'description' => 'Pantallas y monitores de alta resolución.'],
            ['name' => 'Redes', 'description' => 'Routers, switches y otros equipos de red.'],
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
