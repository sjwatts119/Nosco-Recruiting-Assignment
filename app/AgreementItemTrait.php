<?php

namespace App;

trait AgreementItemTrait
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'quantity' => 'required|integer|min:1|max:99',
            'cost_price' => ['required', 'numeric', 'min:0', 'max:99999', 'decimal:0,2'],
            'retail_price' => ['required', 'numeric', 'min:0', 'max:99999', 'decimal:0,2'],
        ];
    }

    /**
     * Format the prices to pennies as we store them as integers to prevent rounding errors.
     *
     * @param array $validated
     * @return array
     */
    public function formatPrices(array $validated): array
    {
        // Convert prices to integers (pennies)
        $validated['cost_price'] = intval($validated['cost_price'] * 100);
        $validated['retail_price'] = intval($validated['retail_price'] * 100);
        return $validated;
    }
}
