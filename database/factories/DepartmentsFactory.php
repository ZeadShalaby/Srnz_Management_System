<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departments>
 */
class DepartmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //
        $img = array("a (1).jpg","a (2).jpg","a (3).jpg", "a (4).jpg","a (5).jpg","a (6).jpg","a (7).jpg","a (8).jpg","a (9).jpg","a (10).jpg","a (11).jpg","a (12).jpg","a (13).jpg");
        $increment = random_int(0,12);
        return [
            'name' => $this->faker->company,
            'code' => $this->faker->unique()->regexify('[A-Z]{3}'),
            'img' =>$img[$increment],
        ];
    }

  
}
