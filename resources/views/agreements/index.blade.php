<x-app-layout>
    <div class="container mx-auto max-w-screen-xl mt-10">
        <div class="bg-gray-800 p-4 rounded-lg mt-4">
            <livewire:view-agreements />
        </div>
    </div>

    {{-- Success Toast Notification --}}
    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 10000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            id="toast-success"
            class="fixed bottom-4 right-4 z-50 flex items-center w-full max-w-xs p-4 space-x-4 text-white divide-x divide-white rounded-lg shadow bg-green-500"
            role="alert"
        >
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
            <div class="ps-4 text-sm font-normal">{{ session('success') }}</div>
        </div>
    @endif
</x-app-layout>
