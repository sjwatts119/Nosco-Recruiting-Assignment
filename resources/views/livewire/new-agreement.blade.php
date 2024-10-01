<div x-data="{ success: false }" x-on:agreement-created.window="success = true; setTimeout(() => success = false, 5000)">
    <form wire:submit.prevent="newPurchaseAgreement">
        <div class="grid gap-6 mb-10 grid-cols-1 md:grid-cols-3">
            <div>
                <label for="customer_forename" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer's First Name:</label>
                <input type="text" id="customer_forename" wire:model="customerForename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" autocomplete="off" data-1p-ignore data-bwignore data-lpignore="true" data-form-type="other" required />
                @error('customerForename') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="customer_surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer's Surname:</label>
                <input type="text" id="customer_surname" wire:model="customerSurname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" autocomplete="off" required />
                @error('customerSurname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="customer_date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer's Date of Birth:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input
                        wire:model="customerDateOfBirth"
                        id="customer_date_of_birth"
                        datepicker
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date"
                        required
                        data-1p-ignore
                        data-bwignore
                        data-lpignore="true"
                        autocomplete="off"
                        @change-date.camel="@this.set('customerDateOfBirth', $event.target.value)"
                    >
                </div>
                @error('customerDateOfBirth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr class="my-10 border-gray-700" />

        <div class="flex justify-end mb-4">
            <button type="button" wire:click="$dispatch('openModal', { component: 'add-agreement-item' })" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg transition">Add New Item</button>
        </div>

        <div class="relative overflow-x-auto border border-gray-700 sm:rounded-lg mb-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Item Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cost Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Retail Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if(count($items) === 0)
                    <tr>
                        <td colspan="5" class="text-center py-4">No items added yet.</td>
                    </tr>
                @else
                    @foreach($items as $item)
                        <x-item-table-row :item="$item" :index="$loop->index" />
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        @error('items') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg transition">Create Agreement</button>
        </div>
    </form>
</div>

@script
    <script>
        document.addEventListener("livewire:navigating", () => {
            // Reinitialize Flowbite Datepicker before Livewire performs the navigation
            initFlowbite();
        });

        document.addEventListener("livewire:navigated", () => {
            // Reinitialize Flowbite Datepicker after Livewire has finished loading the new page
            initFlowbite();
        });
    </script>
@endscript

