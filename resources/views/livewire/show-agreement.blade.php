<div>
    <div class="mx-auto max-w-5xl my-10">
        <div class="w-full flex justify-between">
            <a href="{{ route('agreements.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg transition" wire:navigate>Back</a>

            {{-- void button for this agreement --}}
            @if($agreement->voided_at)
                <button wire:click="unvoidAgreement" type="button" class="bg-green-500 hover:bg-green-700 text-white text-sm py-2 px-4 rounded-lg transition">Unvoid Agreement</button>
            @else
                <button wire:click="voidAgreement" type="button" class="bg-red-500 hover:bg-red-700 text-white text-sm py-2 px-4 rounded-lg transition">Void Agreement</button>
            @endif
        </div>
        <div class="bg-gray-800 p-10 rounded-lg mt-4">
            <div class="flex justify-between">
                <div class="flex flex-col">
                        <h1 class="text-white text-2xl font-bold">{{ $agreement->customer_forename }} {{ $agreement->customer_surname }}</h1>

                    <p class="text-white text-sm">{{ $agreement->customer_date_of_birth }}</p>
                </div>

                @if($agreement->voided_at === null)
                    <span class="self-center bg-green-500 text-green-800 text-sm font-medium px-2.5 py-1.5 rounded-2xl dark:bg-green-800 dark:text-green-200">Active</span>
                @else
                    <span class="self-center bg-red-500 text-red-800 text-sm font-medium px-2.5 py-1.5 rounded-2xl dark:bg-red-800 dark:text-red-200">Voided</span>
                @endif
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
