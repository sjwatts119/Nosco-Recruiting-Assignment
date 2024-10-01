<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AddAgreementItem extends ModalComponent
{
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

    public function mount() : void {
        // On mount, set the default values for the numerical fields
        $this->quantity = 1;
        $this->cost_price = 0.00;
        $this->retail_price = 0.00;
    }

    public function addItem() : void {
        // Validate the input
        $validated = $this->validate();

        // Ensure prices have two decimal places
        $validated['cost_price'] = number_format($validated['cost_price'], 2);
        $validated['retail_price'] = number_format($validated['retail_price'], 2);

        // Close the modal passing the validated input to the parent component
        $this->closeModalWithEvents([
            NewAgreement::class => ['addItem', [
                'data' => $validated
            ]]
        ]);
    }

    public function render()
    {
        return view('livewire.add-agreement-item');
    }
}
