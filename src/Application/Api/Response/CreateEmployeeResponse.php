<?php
declare(strict_types=1);

namespace App\Application\Api\Response;

use Symfony\Component\HttpFoundation\Response;
use App\Application\Payload\CreateEmployeePayload;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CreateEmployeeResponse
{
    public function __invoke(CreateEmployeePayload $payload): Response
    {
        return new JsonResponse([
            'employee_id' => $payload->id,
        ]);
    }
}
