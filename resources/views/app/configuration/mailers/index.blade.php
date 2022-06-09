<x-mailcoach-ui::layout-settings :title="__('Mailers')">
    <div class="table-actions" x-data>
        <x-mailcoach::button x-on:click="$store.modals.open('create-mailer')" :label="__('Create new mailer')" />

        <x-mailcoach::modal title="Create mailer" name="create-mailer" :open="$errors->any()">
            @livewire('mailcoach-ui::create-mailer')
        </x-mailcoach::modal>

        <div class=table-filters>
            <x-mailcoach::search :placeholder="__('Filter mailers…')" />
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <x-mailcoach::th sort-by="name" sort-default>{{ __('Name') }}</x-mailcoach::th>
            <x-mailcoach::th sort-by="transport">{{ __('Transport') }}</x-mailcoach::th>
            <x-mailcoach::th sort-by="ready_for_use">{{ __('Ready for use') }}</x-mailcoach::th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($mailers as $mailer)
            <tr>
                <td class="markup-links">
                    <a href="{{ route('mailers.edit', $mailer) }}">
                        {{ $mailer->name }}
                    </a>
                </td>
                <td>{{ $mailer->transport->value }}</td>
                <td>{{ $mailer->ready_for_use ? '✅' : '❌' }} </td>
                <td class="td-action">
                        <x-mailcoach::dropdown direction="left">
                            <ul>
                                <li>
                                    <x-mailcoach::form-button :action="route('mailers.delete', $mailer)" method="DELETE" data-confirm>
                                        <x-mailcoach::icon-label icon="far fa-trash-alt" :text="__('Delete')" :caution="true" />
                                    </x-mailcoach::form-button>
                                </li>
                            </ul>
                        </x-mailcoach::dropdown>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-mailcoach::table-status :name="__('mailer|mailers')" :paginator="$mailers" :total-count="$totalMailersCount" :show-all-url="route('mailers')">
    </x-mailcoach::table-status>
</x-mailcoach-ui::layout-settings>
