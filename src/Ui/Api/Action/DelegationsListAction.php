<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Application\MessageBus\QueryBusInterface;
use App\Ui\Api\Response\NotFoundResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Query\DelegationsListQuery;
use App\Ui\Api\Response\DelegationsListResponse;
use App\Domain\Exception\EmployeeNotFoundException;

final class DelegationsListAction
{
    public function __construct(
        private QueryBusInterface $query_bus,
    ) {}

    public function __invoke(Request $request): Response
    {
        try {
            $result = $this->query_bus->dispatch(
                new DelegationsListQuery((int) $request->get('id') ?: null)
            );
        } catch (EmployeeNotFoundException) {
            return (new NotFoundResponse())();
        }

        return (new DelegationsListResponse())($result);
    }
}
