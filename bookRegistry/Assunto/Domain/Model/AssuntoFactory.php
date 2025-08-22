<?php

namespace BookRegistry\Assunto\Domain\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class AssuntoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assunto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Descricao' => fake()->unique()->randomElement([
                'Ficção',
                'Não-ficção',
                'Biografia',
                'Fantasia',
                'Romance',
                'Mistério',
                'História',
                'Ciência',
                'Autoajuda',
                'Tecnologia',
            ]),
        ];
    }
}
