<div>
    <div class="bg-gray-800 p-4 rounded-lg">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4" type="button">
            @if($dateRange === 'all-time')
                All Time
            @elseif($dateRange === 'last-year')
                Last Year
            @elseif($dateRange === 'last-month')
                Last Month
            @else
                Select Date Range
            @endif
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <button wire:click="selectDateRange('all-time')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">
                        All Time
                    </button>
                </li>
                <li>
                    <button wire:click="selectDateRange('last-year')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">
                        Last Year
                    </button>
                </li>
                <li>
                    <button wire:click="selectDateRange('last-month')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">
                        Last Month
                    </button>
                </li>
            </ul>
        </div>
        <div class="relative overflow-x-auto border border-gray-700 sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="id" label="ID" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="name" label="Name" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="agreements_count" label="Agreements" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="total_items" label="Total Items" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="total_cost_price" label="Total Cost Price" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="average_cost_price" label="Average Cost Price" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <x-report-table-row-sort-button field="max_cost_price" label="Max Cost Price" :sortField="$sortField" :sortDescending="$sortDescending" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($staff as $user)
                    <x-report-table-row :user="$user" />
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("livewire:navigating", () => {
        // Reinitialize Flowbite Datepicker before Livewire performs the navigation...
        initFlowbite();
    });

    document.addEventListener("livewire:navigated", () => {
        // Reinitialize Flowbite Datepicker after Livewire has finished loading the new page...
        initFlowbite();
    });
</script>
