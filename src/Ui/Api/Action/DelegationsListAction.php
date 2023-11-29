<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Ui\Api\Response\NotFoundResponse;
use App\Ui\Api\Action\AbstractQueryAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Query\DelegationsListQuery;
use App\Ui\Api\Response\DelegationsListResponse;
use App\Domain\Exception\EmployeeNotFoundException;

final class DelegationsListAction extends AbstractQueryAction
{
    public function __invoke(Request $request): Response
    {
        try {
            $result = $this->dispatch(
                new DelegationsListQuery((int) $request->get('id') ?: null)
            );
        } catch (EmployeeNotFoundException) {
            return (new NotFoundResponse())();
        }

        return (new DelegationsListResponse())($result);
    }
}
