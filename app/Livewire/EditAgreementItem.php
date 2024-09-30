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
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
        ];
    }

    public function editItem() : void
    {
        // Validate the input
        $validated = $this->validate();

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
