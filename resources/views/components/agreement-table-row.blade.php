<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $agreement->id }}
    </th>
    <td class="px-6 py-4">
        {{ $agreement->getFullCustomerName() }}
    </td>
    <td class="px-6 py-4">
        {{ $agreement->getTotalItemsCount() }}
    </td>
    <td class="px-6 py-4">
        {{ $agreement->created_at->diffForHumans() }}
    </td>
    <td class="px-6 py-4">
        @if($agreement->voided_at)
            <span class="bg-red-500 hover:bg-red-600 text-red-800 text-sm font-medium inline-flex items-center justify-center w-16 rounded-xl dark:bg-red-900 dark:hover:bg-red-800 dark:text-red-200 border border-red-600 py-0.5 cursor-default transition">Void</span>
        @else
            <span class="bg-green-500 hover:bg-green-600 text-green-800 text-sm font-medium inline-flex items-center justify-center w-16 rounded-xl dark:bg-green-800 dark:hover:bg-green-700 dark:text-green-200 border border-green-600 py-0.5 cursor-default transition">Active</span>
        @endif
    </td>
    <td class="flex items-center px-6 py-4">
        <a href="{{ route('agreements.show', ['slug' => $agreement->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:navigate>View</a>
    </td>
</tr>
