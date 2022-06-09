<?php

use Spatie\MailcoachUi\Models\Mailer;

it('can get and set configuration values', function() {
    /** @var Mailer $mailer */
    $mailer = Mailer::factory()->create();

    $mailer->merge(['a' => 'first value', 'b' => 'second value']);

    expect($mailer->get('a'))->toBe('first value');
    expect($mailer->get('b'))->toBe('second value');

    $mailer->merge(['c' => 'third value']);

    expect($mailer->get('a'))->toBe('first value');
    expect($mailer->get('b'))->toBe('second value');
    expect($mailer->get('c'))->toBe('third value');


});
