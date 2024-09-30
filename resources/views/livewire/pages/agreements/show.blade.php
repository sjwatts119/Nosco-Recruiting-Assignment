<x-app-layout>
    <div class="container mx-auto max-w-5xl my-10">
        <a href="{{ route('agreements.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>Back</a>
        <div class="bg-gray-800 p-10 rounded-lg mt-4">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-white text-2xl font-bold">{{ $agreement->customer_forename }} {{ $agreement->customer_surname }}</h1>
                    <p class="text-white text-sm">{{ $agreement->customer_date_of_birth }}</p>
                </div>

                @foreach($agreement->agreementItems as $item)
                    <div class="bg-gray-700 p-4 rounded-lg mt-4">
                        <div class="flex justify-between">
                            <div class="text-white text-lg font-bold">{{ $item->name }}</div>
                        </div>
                        <div class="text-white text-sm">{{ $item->description }}</div>
                        <div class="text-white text-sm">Quantity: {{ $item->quantity }}</div>
                        <div class="text-white text-sm">Cost Price: £{{ $item->cost_price }}</div>
                        <div class="text-white text-sm">Retail Price: £{{ $item->retail_price }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

