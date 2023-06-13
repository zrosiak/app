<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use Symfony\Component\HttpFoundation\Response;
use App\Application\ActionHandler\CreateEmployeeHandler;
use App\Ui\Api\Response\CreateEmployeeResponse;

final class CreateEmployeeAction
{
    public function __construct(
        private CreateEmployeeHandler $handler
    ) {}

    public function __invoke(): Response
    {
        $result = $this->handler->handle();

        return (new CreateEmployeeResponse())($result);
    }
}
