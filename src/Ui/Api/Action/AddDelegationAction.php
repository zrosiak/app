<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use DateTimeImmutable;
use App\Domain\ValueObject\Country;
use App\Ui\Api\Action\AbstractCommandAction;
use Symfony\Component\HttpFoundation\Request;
use App\Ui\Api\Response\AddDelegationResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Command\AddDelegationCommand;

final class AddDelegationAction extends AbstractCommandAction
{
    public function __invoke(Request $request): Response
    {
        $result = $this->dispatch(
            new AddDelegationCommand(
                (int) $request->get('id') ?: null,
                new DateTimeImmutable($request->get('start')),
                new DateTimeImmutable($request->get('end')),
                Country::fromString($request->get('country')),
            )
        );

        return (new AddDelegationResponse())($result);
    }
}
