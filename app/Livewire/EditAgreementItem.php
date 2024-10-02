<?php

namespace App\Livewire;

use App\AgreementItemTrait;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class EditAgreementItem extends ModalComponent
{
    use AgreementItemTrait;

    public $isEdit = true;

    public $key;

    #[Validate]
    public $name, $description, $quantity, $cost_price, $retail_price;

    /**
     * On mount, divide our prices by 100 to display them in pounds
     *
     * @return void
     */
    public function mount(): void
    {
        $this->cost_price = $this->cost_price / 100;
        $this->retail_price = $this->retail_price / 100;
    }

    /**
     * Take the edited values from the Modal, validate them and dispatch event to parent component, closing the modal
     *
     * @return void
     */
    public function editItem(): void
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

    public function render(): View
    {
        return view('livewire.modal-agreement-item');
    }
}
