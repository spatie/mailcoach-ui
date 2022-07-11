<div class="card-grid">
<x-mailcoach::card>
    <x-mailcoach::info>
        You can use tokens to authenticate against the Mailcoach API. You'll find more info in <a
            href="https://spatie.be/docs/laravel-mailcoach/">our docs</a>.
    </x-mailcoach::info>

    <form
      wire:submit.prevent="save"
      method="POST"
    >
        @csrf

        <div class="flex items-end max-w-xl">
            <div class="flex-grow mr-2">
                <x-mailcoach::text-field
                    :label="__('Token name')"
                    name="name"
                    wire:model.lazy="name"
                    :placeholder="__('My API token')"
                    :required="true"
                    type="text"
                />
            </div>

            <x-mailcoach::button :label="__('Create token')"/>
        </div>

        @error('emails')
        <p class="form-error">{{ $message }}</p>
        @enderror

    </form>


    @if ($newToken)
        <x-mailcoach::help>
            <p class="mb-2">
                We will display this token only once. Make sure to copy it to a safe place.
            </p>

            <pre id="newKey" class="max-w-full whitespace-pre-wrap break-all font-mono bg-white py-1 px-1">{{ $newToken }}</pre>

            <div class="form-buttons justify-end" x-data>
                <span class="cursor-pointer underline text-sm mr-4" @click="$clipboard('{{ $newToken }}'); $el.innerText = 'Copied!'">Copy to clipboard</span>
            </div>
        </x-mailcoach::help>
    @endif

</x-mailcoach::card>

@if (count($tokens))
<x-mailcoach::card class="p-0">
        <table class="table">
            <thead>
            <tr>
                <x-mailcoach::th>{{ __('Name') }}</x-mailcoach::th>
                <x-mailcoach::th>{{ __('Last used at') }}</x-mailcoach::th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tokens as $token)
                <tr>
                    <td>{{ $token->name }}</td>
                    <td>{{ $token->last_used_at ?? 'Not used yet' }}</td>
                    <td class="td-action">
                        <x-mailcoach::confirm-button :confirm-text="__('Are you sure you want to delete this token?')" on-confirm="() => $wire.delete({{ $token->id }})">
                            <x-mailcoach::icon-label icon="far fa-trash-alt" :caution="true"/>
                        </x-mailcoach::confirm-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-mailcoach::card>
    @endif
</div>
