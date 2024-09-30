<div>
    <div class="bg-gray-800 p-4 rounded-lg">
        <form wire:submit.prevent="addItem">
            <div class="mb-4">
                <label for="name" class="block text-white text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-white text-sm font-bold mb-2">Description:</label>
                <input type="text" id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-white text-sm font-bold mb-2">Quantity:</label>
                <input type="number" id="quantity" wire:model="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="cost_price" class="block text-white text-sm font-bold mb-2">Cost Price:</label>
                <input type="number" step="0.01" id="cost_price" wire:model="cost_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="retail_price" class="block text-white text-sm font-bold mb-2">Retail Price:</label>
                <input type="number" step="0.01" id="retail_price" wire:model="retail_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add New Item</button>
            </div>
        </form>
    </div>
</div>
