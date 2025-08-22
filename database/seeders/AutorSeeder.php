<?php

namespace Database\Seeders;

use BookRegistry\Autor\Domain\Model\Autor;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autor::factory()->count(10)->create();
    }
}
