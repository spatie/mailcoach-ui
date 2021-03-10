<form class="flex items-end justify-start" method="POST"  action={{ route('sendTransactionalTestMail') }}>
    @csrf
    <div class="flex-grow max-w-lg">
        <x-mailcoach::text-field :placeholder="__('From Email')" :label="__('From Email')" name="from_email" type="email" :value="auth()->user()->email"/>
    </div>

    <div class="flex-grow max-w-lg ml-2">
        <x-mailcoach::text-field :placeholder="__('To Email')" :label="__('To Email')" name="to_email" type="email"/>
    </div>

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Send Test')" />
    </div>
</form>

