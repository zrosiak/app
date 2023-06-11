<?php
declare(strict_types=1);

namespace App\Application\Api\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AddDelegationResponse
{
    public function __invoke(): Response
    {
        return new JsonResponse(null);
    }
}
