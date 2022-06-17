<x-mailcoach::data-table
    name="mailer"
    :modelClass="config('mailcoach-ui.models.mailer', \Spatie\MailcoachUi\Models\Mailer::class)"
    :rows="$mailers ?? null"
    :totalRowsCount="$totalMailersCount ?? null"
    :columns="[
        ['attribute' => 'name', 'label' => __('Name')],
        ['attribute' => 'transport', 'label' => __('Transport'), 'class' => 'w-48'],
        ['attribute' => 'ready_for_use', 'label' => __('Ready for use'), 'class' => 'w-48'],
        ['class' => 'w-12'],
    ]"
    rowPartial="mailcoach-ui::app.configuration.mailers.partials.row"
    :emptyText="__('No mailers')"
/>
