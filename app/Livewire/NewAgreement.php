<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewAgreement extends Component
{
    #[Validate]
    public $customerForename, $customerSurname, $customerDateOfBirth;
    public $items = [];

    protected $listeners = [
        'addItem',
        'updateItem',
    ];

    public function rules(): array
    {
        return [
            'customerForename' => 'required',
            'customerSurname' => 'required',
            'customerDateOfBirth' => 'required|date_format:m/d/Y|before:today',
        ];
    }

    /**
     * When addItem event is heard, add the item to the array.
     *
     * @param $data
     *
     * @return void
     */
    public function addItem($data): void
    {
        $this->items[] = $data;
    }

    /**
     * Take the key of the item to edit, and open the edit modal sending the current data.
     *
     * @param $key
     *
     * @return void
     */
    public function startEditingItem($key): void
    {
        $item = $this->items[$key];

        // Open the edit modal, passing current data and array key
        $this->dispatch('openModal', component: 'edit-agreement-item', arguments: [
            'name' => $item['name'],
            'description' => $item['description'],
            'quantity' => $item['quantity'],
            'cost_price' => $item['cost_price'],
            'retail_price' => $item['retail_price'],
            'key' => $key
        ]);
    }

    /**
     * When editItem event is heard, modify the item in the array based on the key.
     *
     * @param $data
     * @param $key
     *
     * @return void
     */
    public function updateItem($data, $key): void
    {
        $this->items[$key] = $data;
    }

    /**
     * Remove the item from the array based on the key.
     *
     * @param $key
     *
     * @return void
     */
    public function removeItem($key): void
    {
        unset($this->items[$key]);
    }

    /**
     * Validate the input, and create a new purchase agreement with the items and customer details.
     *
     * @return void
     */
    public function newPurchaseAgreement(): void
    {
        $validated = $this->validate();

        // If there are no items, display an error message
        if (empty($this->items)) {
            $this->addError('items', 'You must add at least one item to the agreement.');
            return;
        }

        // Convert the date format to Y-m-d
        $validated['customerDateOfBirth'] = Carbon::createFromFormat('m/d/Y', $validated['customerDateOfBirth'])->format('Y-m-d');

        $agreement = auth()->user()->agreements()->create([
            'customer_forename' => $validated['customerForename'],
            'customer_surname' => $validated['customerSurname'],
            'customer_date_of_birth' => $validated['customerDateOfBirth'],
        ]);

        foreach ($this->items as $item) {
            $agreement->agreementItems()->create($item);
        }

        $this->items = [];

        // Reset the input fields of the form
        $this->reset(['customerForename', 'customerSurname', 'customerDateOfBirth']);

        // Redirect to the agreements page with a success message
        redirect()->route('agreements.index')->with('success', 'Agreement created successfully!');
    }

    public function render(): View
    {
        return view('livewire.new-agreement');
    }
}
