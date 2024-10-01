<?php

namespace App;

trait AgreementItemTrait
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'quantity' => 'required|integer|min:1',
            'cost_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
        ];
    }

    public function formatPrices(array $validated): array
    {
        // Convert prices to integers (cents)
        $validated['cost_price'] = intval($validated['cost_price'] * 100);
        $validated['retail_price'] = intval($validated['retail_price'] * 100);
        return $validated;
    }
}
