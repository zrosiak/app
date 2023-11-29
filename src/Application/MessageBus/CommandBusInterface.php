<?php

declare(strict_types=1);

namespace App\Application\MessageBus;

use App\Application\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed;
}
