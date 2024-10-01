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
    <td class="flex items-center px-6 py-4 justify-end">
        <a href="{{ route('agreements.show', ['slug' => $agreement->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
    </td>
</tr>
