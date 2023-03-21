<?php

namespace Database\Factories;

use App\Models\Despesa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_usuario' => function() {
                return User::factory()->create()->id;
            },
            'descricao' => fake()->realText(rand(10, 191)),
            'data_despesa' => Carbon::now(),
            'valor' => fake()->numberBetween(10,73421),
        ];
    }
}
