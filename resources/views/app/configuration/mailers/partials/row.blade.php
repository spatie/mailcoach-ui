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
    <td class="td-action">
        <x-mailcoach::confirm-button
            :confirm-text="__('Are you sure you want to delete mailer: :mailer?', ['mailer' => $row->name])"
            onConfirm="() => $wire.deleteMailer({{ $row->id }})"
        >
            <x-mailcoach::icon-label icon="far fa-trash-alt" :caution="true" />
        </x-mailcoach::confirm-button>
    </td>
</tr>
