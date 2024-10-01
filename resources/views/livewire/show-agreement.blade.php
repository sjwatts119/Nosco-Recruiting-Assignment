<div>
    <div class="mx-auto max-w-screen-xl mt-10">
        <div class="w-full flex justify-between">
            <a href="{{ route('agreements.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg transition" wire:navigate>Back</a>

            @if($agreement->voided_at)
                <button wire:click="unvoidAgreement" type="button" class="bg-green-500 hover:bg-green-700 text-white text-sm py-2 px-4 rounded-lg transition">
                    Unvoid Agreement
                </button>
            @else
                <button wire:click="voidAgreement" type="button" class="bg-red-500 hover:bg-red-700 text-white text-sm py-2 px-4 rounded-lg transition">
                    Void Agreement
                </button>
            @endif
        </div>

        <div class="bg-gray-800 p-10 rounded-lg mt-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="flex flex-col">
                    <h1 class="text-white text-2xl font-bold">Purchase Agreement with {{ $agreement->getFullCustomerName() }}</h1>
                </div>

                <div class="flex items-center ml-auto mt-4 md:mt-0">
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded-xl me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                        </svg>
                        {{ $agreement->created_at->diffForHumans() }}
                    </span>

                    @if(!$agreement->voided_at)
                        <span class="self-center bg-green-500 text-green-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded-xl dark:bg-green-800 dark:text-green-200 border border-green-600">Active</span>
                    @else
                        <span class="self-center bg-red-500 text-red-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded-xl dark:bg-red-900 dark:text-red-200 border border-red-600">Voided</span>
                    @endif
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <div class="flex flex-col">
                    <div class="text-white text-lg">Customer: {{ $agreement->getFullCustomerName() }}</div>
                    <div class="text-white text-sm">Date of Birth: {{ $agreement->customer_date_of_birth }}</div>
                </div>
            </div>

            <hr class="my-10 border-gray-600"/>

            <div class="flex space-x-4 justify-center mb-4">
                <div class="bg-green-900 hover:bg-green-800 p-4 rounded-lg mt-4 hover:bg-blue-800 transition">
                    <div class="flex justify-between">
                        <div class="text-white text-lg">Total Cost Price: {{ $agreement->getTotalCostPrice() }}</div>
                    </div>
                </div>
                <div class="bg-blue-900 hover:bg-blue-800 transition p-4 rounded-lg mt-4">
                    <div class="flex justify-between">
                        <div class="text-white text-lg">Total Retail Price: {{ $agreement->getTotalRetailPrice() }}</div>
                    </div>
                </div>
            </div>

            {{-- Products heading --}}
            <h2 class="text-center text-2xl font-bold text-white mt-8 mb-4">Items</h2>

            {{-- List out the products in the agreement --}}
            <div class="flex flex-col mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($agreement->agreementItems as $item)
                        <div class="relative block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition">
                            <span class="absolute top-4 right-4 bg-blue-900 hover:bg-blue-800 transition text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Qty: {{$item->quantity}}
                            </span>

                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$item->name}}</h5>

                            <p class="font-normal text-gray-700 dark:text-gray-400 mt-2">{{ $item->description }}</p>

                            <hr class="my-8 border-gray-200 dark:border-gray-600"/>

                            <div class="flex justify-between items-center gap-x-4">
                                <span class="bg-green-900 hover:bg-green-800 transition text-white text-sm md:text-base px-4 py-2 rounded-lg flex-grow text-center flex items-center justify-center">
                                    Cost Price: £{{ number_format($item->cost_price, 2) }}
                                </span>
                                <span class="bg-blue-900 hover:bg-blue-800 transition text-white text-sm md:text-base px-4 py-2 rounded-lg flex-grow text-center flex items-center justify-center">
                                    Retail Price: £{{ number_format($item->retail_price, 2) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
