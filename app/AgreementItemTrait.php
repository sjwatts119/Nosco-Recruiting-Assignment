<?php

namespace App;

trait AgreementItemTrait
{
    public function rules(): array
    {
        // Validate the input
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'quantity' => 'required|integer|min:1',
            'cost_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'retail_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
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
