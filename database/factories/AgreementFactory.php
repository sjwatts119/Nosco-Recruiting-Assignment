<?php

namespace Database\Factories;

use App\Models\Agreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgreementFactory extends Factory
{
    protected $model = Agreement::class;

    public function definition(): array
    {
        return [
            'customer_forename' => $this->faker->firstName,
            'customer_surname' => $this->faker->lastName,
            'customer_date_of_birth' => $this->faker->date,
            'created_by' => \App\Models\User::factory(),
        ];
    }
}
