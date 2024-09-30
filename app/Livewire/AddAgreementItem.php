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
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
        ];
    }
    public function addItem() : void {
        // Validate the input
        $validated = $this->validate();

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
