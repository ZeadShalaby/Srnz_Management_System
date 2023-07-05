<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\posts;
use App\Models\Orders;
use App\Models\Departments;
use App\Models\Interesteds;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    // Create 5 departments
   $departments = Departments::factory()->count(5)->create();

    User::create([
        'name' => 'Admin',
        'email' => 'admin@admin.srnz',
        'password' => Hash::make('admin'), 
        'gmail'=>fake()->unique()->safeEmail(),
        'phone'=>fake()->numberBetween($min = 123456789, $max = 98561237894),
        'role' =>'1',
        'profile_photo'=>fake()->imageUrl($width=400, $height=400),
        'remember_token' => Str::random(10),
      
    ]); 

    User::create([
        'name' => 'Customer',
        'email' => 'customer@customer.srnz',
        'password' => Hash::make('customer'), 
        'gmail'=>fake()->unique()->safeEmail(),
        'phone'=>fake()->numberBetween($min = 123456789, $max = 98561237894),
        'role' =>'2',
        'profile_photo'=>fake()->imageUrl($width=400, $height=400),
        'remember_token' => Str::random(10),
      
    ]);
      $defAdmin = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'gmail'=>fake()->unique()->safeEmail(),
        'password' => Hash::make('admin'),
        'phone'=>fake()->numberBetween($min = 123456789, $max = 98561237894),
        'role' =>'1',
        'profile_photo'=>fake()->imageUrl($width=400, $height=400),
        'remember_token' => Str::random(10),
    ]);

    $defCustomer = User::factory()->create([  
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'gmail'=>fake()->unique()->safeEmail(),
        'password' => Hash::make('customer'),
        'phone'=>fake()->numberBetween($min = 123456789, $max = 98561237894),
        'role' =>'2',
        'profile_photo'=>fake()->imageUrl($width=400, $height=400),
        'remember_token' => Str::random(10),
    ]);

    $admins = User::factory()
    ->admin()
    ->count(5)
    ->create();
    $admins->push($defAdmin);

    $customer = User::factory()
    ->customer()
    ->count(20)
    ->create();
    $customer->push($defCustomer);

    $order = Orders::factory()
    ->count(30)
    ->state(function (array $attributes) use ($departments, $customer) {
        return [
            'department_id' => $departments->random()->id,
            'user_id' => $customer->random()->id,
        ];
    })->create();
    
    $interested = Interesteds::factory()
    ->count(10)
    ->state(function (array $attributes) use ($order, $customer) {
        return [
            'order_id' => $order->random()->id,
            'user_id' => $customer->random()->id,
        ];
    })->create();

    
    }


       
    
}
