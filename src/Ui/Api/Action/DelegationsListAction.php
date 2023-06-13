<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Ui\Api\Response\NotFoundResponse;
use App\Domain\Exception\EmployeeNotFoundException;
use App\Application\ActionHandler\DelegationsListHandler;
use App\Ui\Api\Response\DelegationsListResponse;

final class DelegationsListAction
{
    public function __construct(
        private DelegationsListHandler $handler
    ) {}

    public function __invoke(Request $request): Response
    {
        try {
            $result = $this->handler->handle(
                (int) $request->get('id') ?: null
            );
        } catch (EmployeeNotFoundException) {
            return (new NotFoundResponse())();
        }

        return (new DelegationsListResponse())($result);
    }
}
