<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password 'password' is hashed
            'remember_token' => Str::random(10),
            'dob' => $this->faker->date('Y-m-d', '2003-09-09'), // Date of birth
            'mobile' => '0771234567',
            'house' => $this->faker->buildingNumber,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
