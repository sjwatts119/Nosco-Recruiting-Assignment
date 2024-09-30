<div x-data="{ success: false }" x-on:agreement-created.window="success = true; setTimeout(() => success = false, 5000)">
    <form wire:submit.prevent="newPurchaseAgreement">
        <div class="mb-4">
            <label for="customer_forename" class="block text-white text-sm font-bold mb-2">Customer Forename:</label>
            <input type="text" id="customer_forename" wire:model="customerForename" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="customer_surname" class="block text-white text-sm font-bold mb-2">Customer Surname:</label>
            <input type="text" id="customer_surname" wire:model="customerSurname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="customer_date_of_birth" class="block text-white text-sm font-bold mb-2">Customer Date of Birth:</label>
            <input type="date" id="customer_date_of_birth" wire:model="customerDateOfBirth" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="bg-gray-800 p-4 rounded-lg mt-4">
            <div class="grid grid-cols-1 gap-4">
                @foreach ($items as $index => $item)
                    <div class="bg-gray-700 p-4 rounded-lg shadow-md flex flex-col sm:flex-row justify-between items-center">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                            <div class="text-white">
                                <p>{{ $item['name'] }}</p>
                            </div>
                            <div class="text-white mt-2 sm:mt-0 flex gap-x-2">
                                <p class="font-bold">x</p>
                                <p>{{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-auto">
                            <button type="button" wire:click="startEditingItem({{ $index }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button type="button" wire:click="removeItem({{ $index }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="button" wire:click="$dispatch('openModal', { component: 'add-agreement-item' })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add New Item</button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Agreement</button>
        </div>
    </form>

    <div wire:transition x-show="success" class="mt-4 p-4 bg-green-500 text-white rounded">
        Agreement created successfully!
    </div>
</div>
