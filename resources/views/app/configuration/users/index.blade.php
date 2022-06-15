<x-mailcoach::data-table
    name="user"
    :modelClass="\Spatie\MailcoachUi\Models\User::class"
    :rows="$users ?? null"
    :totalRowsCount="$totalUsersCount ?? null"
    :columns="[
        ['attribute' => 'email', 'label' => __('Email')],
        ['attribute' => 'name', 'label' => __('Name')],
        ['class' => 'w-12'],
    ]"
    rowPartial="mailcoach-ui::app.configuration.users.partials.row"
    :emptyText="__('No users')"
/>
