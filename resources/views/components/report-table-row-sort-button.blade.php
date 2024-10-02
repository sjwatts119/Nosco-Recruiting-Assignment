<button wire:click="sortBy('{{ $field }}')" class="whitespace-nowrap inline-flex items-center">
    {{ $label }}
    @if ($sortField === $field)
        @if ($sortDescending)
            <span class="ml-1">▼</span>
        @else
            <span class="ml-1">▲</span>
        @endif
    @else
        <span class="ml-1 invisible">▼</span>
    @endif
</button>
