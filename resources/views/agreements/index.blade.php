<x-app-layout>
    <div class="container mx-auto max-w-screen-xl sm:mt-10 p-4">
        <div class="bg-gray-800 p-4 rounded-lg">
            <livewire:view-agreements />
        </div>
    </div>

    {{-- Success Toast Notification --}}
    @if(session('success'))
        <x-success-toast :message="session('success')" />
    @endif
</x-app-layout>
