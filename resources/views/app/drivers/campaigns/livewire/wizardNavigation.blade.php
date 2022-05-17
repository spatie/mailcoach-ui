<ul>
    @foreach($steps as $step)
        <li class="{{ $step->isPrevious() ? 'underline' : '' }} {{ $step->isCurrent() ? 'text-red-500' : '' }}"
            @if ($step->isPrevious())
                wire:click="{{ $step->show() }}"
            @endif
        >
            {{ $step->label }}</li>
    @endforeach
</ul>
