<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interesteds>
 */
class InterestedsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderids = Orders::pluck('id')->toArray();
        $userids = User::where('role', '2')->pluck('id')->toArray();

        return [
            'order_id' => $this->faker->randomElement($orderids),          
            'user_id' => $this->faker->randomElement($userids),
        ];
    }
}
