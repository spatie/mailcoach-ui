<?php

namespace Spatie\MailcoachUi\Tests\Unit\Support\MailConfiguration;

use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\PostalConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\SmtpConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfigurationDriverRepository;
use Spatie\MailcoachUi\Tests\TestCase;

class MailConfigurationDriverRepositoryTest extends TestCase
{
    /** @test */
    public function it_can_find_a_driver_for_the_given_string()
    {
        $repository = new MailConfigurationDriverRepository();

        $this->assertInstanceOf(SmtpConfigurationDriver::class, $repository->getForDriver('smtp'));

        $this->assertNull($repository->getForDriver('invalid-driver'));
    }

    /** @test */
    public function it_can_find_a_mail_postal_driver()
    {
        $repository = new MailConfigurationDriverRepository();

        $this->assertInstanceOf(PostalConfigurationDriver::class, $repository->getForDriver('postal'));

        $this->assertNull($repository->getForDriver('invalid-driver'));
    }
}
