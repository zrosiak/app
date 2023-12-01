<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Service\EmployeeService;
use App\Application\Query\DelegationsListQuery;
use App\Application\Payload\DelegationsListPayload;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class DelegationsListQueryHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {}

    public function __invoke(DelegationsListQuery $query): DelegationsListPayload
    {
        $delegations = $this->employee_service->getDeleagtions($query->employee_id);

        return new DelegationsListPayload($delegations);
    }
}
