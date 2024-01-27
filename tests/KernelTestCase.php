<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as KernelTestCaseBase;

class KernelTestCase extends KernelTestCaseBase
{
    private $container;

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->container = static::getContainer();
    }
}
