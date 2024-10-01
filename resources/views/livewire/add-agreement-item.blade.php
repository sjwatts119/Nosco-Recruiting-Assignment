<div>
    <div class="bg-gray-800 p-6 rounded-lg">
        <form wire:submit.prevent="addItem">
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter item name...">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description:</label>
                <textarea id="description" wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter item description..."></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div x-data="{
                quantity: 1,
                cost_price: 0,
                retail_price: 0,
                validatePositive(value) {
                    return Math.max(value, 0);
                },
                validateQuantity(value) {
                    return Math.max(value, 1);
                }
            }">
                <div class="mb-4">
                    <label for="quantity" class="block text-white text-sm font-bold mb-2">Quantity:</label>
                    <input wire:model="quantity"
                            type="number"
                            id="quantity"
                            x-model.number="quantity"
                            @input="quantity = validateQuantity(quantity)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter quantity..."
                            required />
                    @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="cost_price" class="block text-white text-sm font-bold mb-2">Cost Price:</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none text-gray-300">
                            £
                        </div>
                        <input wire:model="cost_price"
                               type="number"
                               step="0.01"
                               id="cost_price"
                               x-model.number="cost_price"
                               @input="cost_price = validatePositive(cost_price)"
                               class="ps-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Enter cost price..."
                               required />
                    </div>
                    <div>
                        @error('cost_price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="mb-8">
                    <label for="retail_price" class="block text-white text-sm font-bold mb-2">Retail Price:</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none text-gray-300">
                            £
                        </div>
                        <input wire:model="retail_price"
                                type="number"
                                step="0.01"
                                id="retail_price"
                                x-model.number="retail_price"
                                @input="retail_price = validatePositive(retail_price)"
                                class="ps-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter retail price..."
                                required />
                    </div>
                    <div>
                        @error('retail_price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg transition">Add New Item</button>
            </div>
        </form>
    </div>
</div>
