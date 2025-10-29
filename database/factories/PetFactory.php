<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = $this->faker->randomElement([
            'dog',
            'cat',
            'bird',
            'reptile',
            'rodent',
            'fish',
            'amphibian',
            'other'
        ]);

        $breeds = [
            'dog' => ['Labrador', 'Bulldog', 'Poodle', 'German Shepherd', 'Beagle'],
            'cat' => ['Siamese', 'Persian', 'Maine Coon', 'Bengal', 'Sphynx'],
            'bird' => ['Canary', 'Parrot', 'Cockatiel', 'Finch', 'Macaw'],
            'reptile' => ['Iguana', 'Gecko', 'Turtle', 'Snake'],
            'rodent' => ['Hamster', 'Guinea Pig', 'Mouse', 'Rat'],
            'fish' => ['Goldfish', 'Betta', 'Guppy', 'Angelfish', 'Tetra'],
            'amphibian' => ['Frog', 'Salamander', 'Newt', 'Toad'],
            'other' => ['Rabbit', 'Ferret', 'Hedgehog'],
        ];

        $speciesBreed = $this->faker->randomElement($breeds[$species]);

        return [
            'user_id' => User::role('client')->inRandomOrder()->first()->id,
            'name' => $this->faker->firstName(),
            'species' => $species,
            'breed' => $speciesBreed,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'birthdate' => $this->faker->dateTimeBetween('-10 years', '-3 months'),
            'photo' => $this->faker->imageUrl(400, 400, 'animals', true),
        ];
    }
}
