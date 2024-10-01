<?php

namespace App\Livewire;

use App\AgreementItemTrait;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class EditAgreementItem extends ModalComponent
{
    use AgreementItemTrait;

    public $isEdit = true;

    public $key;

    #[Validate]
    public $name, $description, $quantity, $cost_price, $retail_price;

    public function mount() : void
    {
        // On mount, divide our prices by 100 to display them in pounds
        $this->cost_price = $this->cost_price / 100;
        $this->retail_price = $this->retail_price / 100;
    }

    public function editItem() : void
    {
        // Validate the input
        $validated = $this->validate();

        // Convert the prices to integers (pennies)
        $validated = $this->formatPrices($validated);

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
        return view('livewire.modal-agreement-item');
    }
}
