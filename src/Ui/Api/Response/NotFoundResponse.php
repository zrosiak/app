<?php

declare(strict_types=1);

namespace App\Ui\Api\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class NotFoundResponse
{
    public function __invoke(): Response
    {
        return new JsonResponse(null, 404);
    }
}
