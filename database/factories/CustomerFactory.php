<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //llamar al modelo Customer factory
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' =>$this->faker->address(),
            'photo' =>$this->faker->imageUrl(100, 100, 'people'),
            'status' => $this->faker->randomElement(['active', 'inactive']), // Genera un estado aleatorio (activo o inactivo)
            'ruc' => $this->faker->unique()->numerify('###########'),
        ];
    }
}
