<nav class="mb-8 flex items-center gap-x-4" aria-label="Tabs">
    @foreach($steps as $step)
        <div class="relative 
            group inline-flex h-8 items-center font-medium
            {{ $step->isCurrent() ? 'text-blue-700 
            before:content-[""] 
            before:absolute
            before:left-0
            before:bottom-0
            before:h-[3px]
            before:w-full
            before:rounded-full
            before:bg-gradient-to-r
            before:from-blue-400
            before:to-indigo-500' : '' }}
            {{ $step->isPrevious() ? 'hover:text-blue-800' : '' }}
        "
            @if ($step->isPrevious())
                wire:click="{{ $step->show() }}"
            @endif
        >
            <span>{{ $step->label }}</span>
        </div>

        @if (! $loop->last)
            <i class="far fa-arrow-right text-xs text-blue-300"></i>
        @endif
    @endforeach
</nav>
