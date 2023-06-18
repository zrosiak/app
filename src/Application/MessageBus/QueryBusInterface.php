<?php
declare(strict_types=1);

namespace App\Application\MessageBus;

use App\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $command): mixed;
}
