<?php

namespace App\Livewire;

use App\Models\AgreementItem;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewAgreement extends Component
{
    #[Validate]
    public $customerForename, $customerSurname, $customerDateOfBirth;
    public $items = [];

    // Event listener for addNewPurchaseAgreementItem
    protected $listeners = [
        'addItem',
        'updateItem',
    ];

    public function rules() : array
    {
        return [
            'customerForename' => 'required',
            'customerSurname' => 'required',
            'customerDateOfBirth' => 'required|date_format:m/d/Y',
        ];
    }

    // On addNewPurchaseAgreementItem event
    public function addItem($data) : void
    {
        // Add the new item to the array
        $this->items[] = $data;
    }

    public function startEditingItem($key) : void
    {
        // Get the item from the array
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

    // On updateItem event
    public function updateItem($data, $key) : void
    {
        // Update the item in the array
        $this->items[$key] = $data;
    }

    public function removeItem($key) : void
    {
        // Remove the item from the array
        unset($this->items[$key]);
    }

    public function newPurchaseAgreement() : void
    {
        // Validate the input
        $validated = $this->validate();

        // Convert the date format to Y-m-d
        $validated['customerDateOfBirth'] = Carbon::createFromFormat('m/d/Y', $validated['customerDateOfBirth'])->format('Y-m-d');

        // Create the new agreement
        $agreement = auth()->user()->agreements()->create([
            'customer_forename' => $validated['customerForename'],
            'customer_surname' => $validated['customerSurname'],
            'customer_date_of_birth' => $validated['customerDateOfBirth'],
        ]);

        // Save all items to the database
        foreach ($this->items as $item) {
            $agreement->agreementItems()->create($item);
        }

        // Clear the array
        $this->items = [];

        // Reset the input fields
        $this->reset(['customerForename', 'customerSurname', 'customerDateOfBirth']);

        // Dispatch success message
        $this->dispatch('agreement-created');

        // Redirect to the agreements page
        redirect()->route('agreements.index');
    }

    public function render() : View
    {
        return view('livewire.new-agreement');
    }
}
