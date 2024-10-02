<button wire:click="sortBy('{{ $field }}')">
    {{ $label }}
    @if ($sortField === $field)
        @if ($sortDescending)
            <span>▼</span>
        @else
            <span>▲</span>
        @endif
    @endif
</button>
