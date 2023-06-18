<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Ui\Api\Action\AbstractCommandAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Ui\Api\Response\CreateEmployeeResponse;
use App\Application\Command\CreateEmployeeCommand;

final class CreateEmployeeAction extends AbstractCommandAction
{
    public function __invoke(Request $request): Response
    {
        $result = $this->dispatch(
            new CreateEmployeeCommand()
        );

        return (new CreateEmployeeResponse())($result);
    }
}
