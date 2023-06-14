<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use Symfony\Component\HttpFoundation\Response;
use App\Application\ActionHandler\AddDelegationHandler;
use App\Domain\ValueObject\Country;
use App\Ui\Api\Response\AddDelegationResponse;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;

final class AddDelegationAction
{
    public function __construct(
        private AddDelegationHandler $handler
    ) {}

    public function __invoke(Request $request): Response
    {
        $result = $this->handler->handle(
            (int) $request->get('id') ?: null,
            new DateTimeImmutable($request->get('start')),
            new DateTimeImmutable($request->get('end')),
            Country::fromString($request->get('country')),
        );

        return (new AddDelegationResponse())($result);
    }
}
