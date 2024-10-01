<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class EditAgreementItem extends ModalComponent
{
    public $key;

    #[Validate]
    public $name, $description, $quantity, $cost_price, $retail_price;

    public function rules() : array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'quantity' => 'required|integer|min:1',
            'cost_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
        ];
    }

    public function editItem() : void
    {
        // Validate the input
        $validated = $this->validate();

        // Ensure prices have two decimal places
        $validated['cost_price'] = number_format($validated['cost_price'], 2);
        $validated['retail_price'] = number_format($validated['retail_price'], 2);

        // Dispatch event to parent component
        $this->closeModalWithEvents([
            NewAgreement::class => ['updateItem', [
                'data' => $validated,
                'key' => $this->key,
            ]]
        ]);
    }

    public function render()
    {
        return view('livewire.edit-agreement-item');
    }
}
