<nav class="h-12 flex items-center gap-x-4 text-gray-700 text-sm" aria-label="Tabs">
    @foreach($steps as $step)
        <div class="
            border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 text-sm
            {{ $step->isCurrent() ? 'font-bold' : 'font-medium' }}
        "
            @if ($step->isPrevious())
                wire:click="{{ $step->show() }}"
            @endif
        >
            <span>{{ $step->label }}</span>
        </div>

        @if (! $loop->last)
            <span>&gt;</span>
        @endif
    @endforeach
</nav>
