<?php

namespace App\Livewire;

use App\AgreementItemTrait;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AddAgreementItem extends ModalComponent
{
    use AgreementItemTrait;

    public $isEdit = false;

    #[Validate]
    public $name, $description, $quantity, $cost_price, $retail_price;

    public function mount() : void {
        // On mount, set the default values for the numerical fields
        $this->quantity = 1;
    }

    public function addItem() : void {
        // Validate the input
        $validated = $this->validate();

        // Convert the prices to integers (pennies)
        $validated = $this->formatPrices($validated);

        // Close the modal passing the validated input to the parent component
        $this->closeModalWithEvents([
            NewAgreement::class => ['addItem', [
                'data' => $validated
            ]]
        ]);
    }

    public function render()
    {
        return view('livewire.modal-agreement-item');
    }
}
