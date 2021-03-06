<?php

namespace Database\Factories;

use App\Models\FitnessTrainer;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'resolution'=>$this->faker->numberBetween(100,3000),
            'length'=>$this->faker->numberBetween(300,10000),
            'owner'=>$this->faker->userName(),
            'fitnesstrainer_id'=>FitnessTrainer::factory(),
            'folder_id'=>Folder::factory(),
        ];
    }
}
