<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $item['name'] }}
    </th>
    <td class="px-6 py-4">
        {{ $item['quantity'] }}
    </td>
    <td class="px-6 py-4">
        £{{ number_format($item['cost_price'] / 100, 2) }} (Total: £{{ number_format(($item['cost_price'] * $item['quantity']) / 100, 2) }})
    </td>
    <td class="px-6 py-4">
        £{{ number_format($item['retail_price'] / 100, 2) }} (Total: £{{ number_format(($item['retail_price'] * $item['quantity']) / 100, 2) }})
    </td>
    <td class="flex items-center px-6 py-4">
        <button type="button" wire:click="startEditingItem({{ $index }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
        <button type="button" wire:click="removeItem({{ $index }})" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</button>
    </td>
</tr>
