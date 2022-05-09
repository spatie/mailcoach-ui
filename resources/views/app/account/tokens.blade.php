<x-mailcoach-ui::layout-settings :title="__('API Tokens')">
    <x-mailcoach::help>
        You can use tokens to authenticate against the Mailcoach API. You'll find more info in <a
            href="https://spatie.be/docs/laravel-mailcoach/">our docs</a>.
    </x-mailcoach::help>

    <form class="my-6"
          action="{{ route('tokens.create') }}"
          method="POST"
          data-dirty-check
    >
        @csrf

        <div class="flex items-end max-w-xl">
            <div class="flex-grow mr-2">
                <x-mailcoach::text-field
                    :label="__('Token name')"
                    name="name"
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


    @if (session()->has('newToken'))
        @push('modals')
            <x-mailcoach::modal :open="true" :title="__('Your new token')" name="token">
                <p class="mb-2">
                    We will display this token only once. Make sure to copy it to a safe place.
                </p>


                <pre id="newKey" class="max-w-full whitespace-pre-wrap break-all font-mono bg-gray-100">{{ session()->get('newToken') }}</pre>


                <div class="form-buttons justify-end">
                    <div>
                        <span class="cursor-pointer underline text-sm mr-4" x-on:click="(e) => window.copyToClipboard('{{ session()->get('newToken') }}').then(() => e.target.innerText = 'Copied!')">Copy to clipboard</span>
                        <button type="button" class="button" x-on:click="$store.modals.close('token')">
                            {{ __('OK') }}
                        </button>
                    </div>
                </div>
            </x-mailcoach::modal>
            <script>
                function copyToClipboard(textToCopy) {
                    // navigator clipboard api needs a secure context (https)
                    if (navigator.clipboard && window.isSecureContext) {
                        // navigator clipboard api method'
                        return navigator.clipboard.writeText(textToCopy);
                    } else {
                        // text area method
                        let textArea = document.createElement("textarea");
                        textArea.value = textToCopy;
                        // make the textarea out of viewport
                        textArea.style.position = "fixed";
                        textArea.style.left = "-999999px";
                        textArea.style.top = "-999999px";
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        return new Promise((res, rej) => {
                            // here the magic happens
                            document.execCommand('copy') ? res() : rej();
                            textArea.remove();
                        });
                    }
                }
            </script>
        @endpush
    @endif

    @if (count($tokens))
        <table class="table mt-8">
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
                        <x-mailcoach::dropdown direction="left">
                            <ul>
                                <li>
                                    <x-mailcoach::confirm-button :action="route('tokens.delete', $token)" method="DELETE">
                                        <x-mailcoach::icon-label icon="far fa-trash-alt" :text="__('Delete')" :caution="true"/>
                                    </x-mailcoach::confirm-button>
                                </li>
                            </ul>
                        </x-mailcoach::dropdown>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</x-mailcoach-ui::layout-settings>
