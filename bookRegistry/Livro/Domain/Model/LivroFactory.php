<?php

namespace BookRegistry\Livro\Domain\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class LivroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Livro::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Titulo' => fake()->unique()->text(maxNbChars: 40),
            'Editora' => fake()->company(),
            'Edicao' => fake()->randomDigitNotZero(),
            'AnoPublicacao' => fake()->year(max: 'now'),
            'Valor' => fake()->randomNumber(5)
        ];
    }
}
