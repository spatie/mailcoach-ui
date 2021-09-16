<?php

namespace Spatie\MailcoachUi\Tests\Unit\Support\TransactionalMailConfiguration;

use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\SmtpConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\PostalConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfigurationDriverRepository;
use Spatie\MailcoachUi\Tests\TestCase;

class TransactionMailConfigurationDriverRepositoryTest extends TestCase
{
    /** @test */
    public function it_can_find_a_transaction_smtp_driver()
    {
        $repository = new TransactionalMailConfigurationDriverRepository();

        $this->assertInstanceOf(SmtpConfigurationDriver::class, $repository->getForDriver('smtp'));

        $this->assertNull($repository->getForDriver('invalid-driver'));
    }

    /** @test */
    public function it_can_find_a_transaction_postal_driver()
    {
        $repository = new TransactionalMailConfigurationDriverRepository();

        $this->assertInstanceOf(PostalConfigurationDriver::class, $repository->getForDriver('postal'));

        $this->assertNull($repository->getForDriver('invalid-driver'));
    }
}
