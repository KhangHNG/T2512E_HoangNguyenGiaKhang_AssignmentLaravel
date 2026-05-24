<?php

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;


class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerVi = \Faker\Factory::create('vi_VN');

        return [
            'account_number' => $this->faker->unique()->numerify('##########'),
            'full_name' => $fakerVi->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $fakerVi->phoneNumber(),
            'balance' => $this->faker->randomFloat(2, 0, 500000000),
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'inactive', 'banned']),
        ];
    }
}
