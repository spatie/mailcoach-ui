<nav class="h-12 flex items-center gap-x-4 text-gray-700 text-sm" aria-label="Tabs">
    @foreach($steps as $step)
        <div class="
            text-gray-500 hover:text-gray-700 group inline-flex items-center px-1 text-sm
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
