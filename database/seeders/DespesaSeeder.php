<?php

namespace Database\Seeders;

use App\Models\Despesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DespesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Despesa::factory()->count(50)->create();
    }
}
