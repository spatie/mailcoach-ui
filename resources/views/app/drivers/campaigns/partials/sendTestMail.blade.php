<form class="form-grid" method="POST" action={{ route('sendTestMail') }}>
    @csrf
    <x-mailcoach::text-field :placeholder="__('From Email')" :label="__('From Email')" name="from_email" type="email" :value="auth()->user()->email"/>

    <x-mailcoach::text-field :placeholder="__('To Email')" :label="__('To Email')" name="to_email" type="email"/>

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Send Test')" />
    </div>
</form>

