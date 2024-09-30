<x-app-layout>
    <div class="container mx-auto max-w-5xl my-10">

        <a href="{{ route('agreements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>Create New Agreement</a>

        <div class="bg-gray-800 p-4 rounded-lg mt-4">
            <livewire:view-agreements />
        </div>
    </div>
</x-app-layout>
