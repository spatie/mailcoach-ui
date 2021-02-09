<x-mailcoach-ui::layout-settings :title="__('Users')">
    <div class="table-actions">
        <x-mailcoach::button data-modal-trigger="create-user" :label="__('Create new user')" />

        <x-mailcoach::modal title="Create user" name="create-user" :open="$errors->any()">
            @include('mailcoach-ui::app.configuration.users.partials.create')
        </x-mailcoach::modal>

        <div class=table-filters>
            <x-mailcoach::search :placeholder="__('Filter users…')" />
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <x-mailcoach::th sort-by="email" sort-default>{{ __('Email') }}</x-mailcoach::th>
                <x-mailcoach::th sort-by="-name">{{ __('Name') }}</x-mailcoach::th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="markup-links">
                    <a href="{{ $user->id === auth()->user()->id ? route('account') : route('users.edit', $user) }}">
                        {{ $user->email }}
                    </a>
                </td>
                <td>{{ $user->name }}</td>
                <td class="td-action">
                    @if ($user->id !== auth()->user()->id)
                    <x-mailcoach::dropdown direction="left">
                        <ul>
                            <li>
                                <x-mailcoach::form-button :action="route('users.delete', $user)" method="DELETE" data-confirm>
                                    <x-mailcoach::icon-label icon="far fa-trash-alt" :text="__('Delete')" :caution="true" />
                                </x-mailcoach::form-button>
                            </li>
                        </ul>
                    </x-mailcoach::dropdown>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <x-mailcoach::table-status :name="__('user|users')" :paginator="$users" :total-count="$totalUsersCount" :show-all-url="route('users')">
    </x-mailcoach::table-status>
</x-mailcoach-ui::layout-settings>