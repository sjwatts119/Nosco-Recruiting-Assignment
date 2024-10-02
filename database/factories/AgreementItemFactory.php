<?php

namespace Database\Factories;

use App\Models\Agreement;
use App\Models\AgreementItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgreementItemFactory extends Factory
{
    protected $model = AgreementItem::class;

    public function definition(): array
    {
        return [
            'agreement_id' => Agreement::factory(), // Default value if not provided
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 10),
            'cost_price' => $this->faker->numberBetween(1, 10000),
            'retail_price' => $this->faker->numberBetween(1, 10000),
        ];
    }

    public function withAgreementId($agreementId): static
    {
        return $this->state(fn (array $attributes) => [
            'agreement_id' => $agreementId,
        ]);
    }
}
