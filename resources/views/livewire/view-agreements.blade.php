<div class="bg-gray-800 p-4 rounded-lg mt-4">

    {{-- Search bar --}}
    <div class="flex justify-between">
        <div class="flex">
            <input type="text" wire:model.live="search" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
        </div>
    </div>


    <div class="bg-gray-800 p-4 rounded-lg mt-4">
        @foreach($agreements as $agreement)
            <div class="bg-gray-700 p-4 rounded-lg mt-4">
                <div class="flex justify-between">
                    <div class="text-white text-lg font-bold">{{ $agreement->customer_forename }} {{ $agreement->customer_surname }}</div>
                    <a href="{{ route('agreements.show', ['slug' => $agreement->id]) }}" class="ml-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>View</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
