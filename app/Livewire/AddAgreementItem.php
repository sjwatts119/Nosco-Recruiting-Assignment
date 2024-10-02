<?php

namespace App\Livewire;

use App\AgreementItemTrait;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AddAgreementItem extends ModalComponent
{
    use AgreementItemTrait;

    public $isEdit = false;

    #[Validate]
    public $name, $description, $quantity, $cost_price, $retail_price;

    /**
     * On mount, set the default values for the numerical fields.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }

    /**
     * Add an item to the agreement and close the modal.
     *
     * @return void
     */
    public function addItem(): void
    {
        $validated = $this->validate();

        // Convert the prices to integers (pennies)
        $validated = $this->formatPrices($validated);

        // Close the modal passing the validated input to the NewAgreement component
        $this->closeModalWithEvents([
            NewAgreement::class => ['addItem', [
                'data' => $validated
            ]]
        ]);
    }

    public function render(): View
    {
        return view('livewire.modal-agreement-item');
    }
}
