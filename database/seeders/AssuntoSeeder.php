<?php

namespace Database\Seeders;

use BookRegistry\Assunto\Domain\Model\Assunto;
use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assunto::factory()->count(10)->create();
    }
}
