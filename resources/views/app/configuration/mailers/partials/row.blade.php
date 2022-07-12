<tr>
    <td class="markup-links">
        <a href="{{ route('mailers.edit', $row) }}">
            {{ $row->name }}
        </a>
    </td>
    <td>{{ $row->transport->label() }}</td>
    <td>
        @if ($row->ready_for_use)
            <x-mailcoach::rounded-icon type="success" icon="fas fa-check" />
        @else
            <x-mailcoach::rounded-icon type="error" icon="fas fa-times" />
        @endif
    </td>
    <td>
        @if ($row->default)
            <x-mailcoach::rounded-icon type="success" icon="fas fa-check" />
        @else
            <x-mailcoach::rounded-icon type="error" icon="fas fa-times" />
        @endif
    </td>
    <td class="td-action">
        <x-mailcoach::dropdown direction="left">
            <ul>
                <li>
                    <button wire:click.prevent="markMailerDefault({{ $row->id }})">
                        <x-mailcoach::icon-label icon="fas fa-check" :text="__('Mark as default')" />
                    </button>
                </li>
                <li>
                    <x-mailcoach::confirm-button
                        :confirm-text="__('Are you sure you want to delete mailer: :mailer?', ['mailer' => $row->name])"
                        onConfirm="() => $wire.deleteMailer({{ $row->id }})"
                    >
                        <x-mailcoach::icon-label icon="far fa-trash-alt" :caution="true" :text="__('mailcoach - Delete')" />
                    </x-mailcoach::confirm-button>
                </li>
            </ul>
        </x-mailcoach::dropdown>
    </td>
</tr>
