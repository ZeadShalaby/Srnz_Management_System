<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Departments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departmentIds = Departments::pluck('id')->toArray();
        $userids = User::where('role', '2')->pluck('id')->toArray();
        $img = array("o (1).jfif","o (1).gif","o (1).png","o (4).png","o (5).png","o (16).jpg","o (17).jpg","o (18).jpg","o (19).jpg","o (20).jpg","o (21).jpg","o (22).jpg","o (23).jpg","o (24).jpg","o (25).jpg","o (26).jpg","o (27).jpg","o (28).jpg","o (29).jpg","o (30).jpg","o (31).jpg","o (32).jpg","o (33).jpg","o (34).jpg","o (35).jpg");
        $increment = random_int(0,24);
        return [
            'name' => $this->faker->company,
            'user_id' => $this->faker->randomElement($userids),
            'department_id' => $this->faker->randomElement($departmentIds),          
            'gmail'=>fake()->unique()->safeEmail(),
            'phone'=>fake()->numberBetween($min = 123456789, $max = 98561237894),
            'description'=>fake()->text(),
            'price'=>fake()->numberBetween($min = 1000, $max = 100000),
            'path'=>$img[$increment],
            'view'=>null,
        ];
    }
}
