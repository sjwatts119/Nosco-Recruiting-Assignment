<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $user->id }}
    </th>
    <td class="px-6 py-4">
        {{ $user->name }}
    </td>
    <td class="px-6 py-4">
        {{ $user->agreements_count }}
    </td>
    <td class="px-6 py-4">
        {{ $user->total_items }}
    </td>
    <td class="px-6 py-4">
        £{{ number_format($user->total_cost_price, 2, '.', ',') }}
    </td>
    <td class="px-6 py-4">
        £{{ number_format($user->average_cost_price, 2, '.', ',') }}
    </td>
    <td class="px-6 py-4">
        £{{ number_format($user->max_cost_price, 2, '.', ',') }}
    </td>
</tr>
