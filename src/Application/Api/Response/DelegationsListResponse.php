<?php
declare(strict_types=1);

namespace App\Application\Api\Response;

use Symfony\Component\HttpFoundation\Response;
use App\Application\Payload\DelegationsListPayload;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DelegationsListResponse
{
    public function __invoke(DelegationsListPayload $payload): Response
    {
        $data = [];

        foreach ($payload->delegations as $delegation) {
            $data[] = [
                'start' => $delegation->getStartDate()->format('d-m-Y H:i:s'),
                'end' => $delegation->getEndDate()->format('d-m-Y H:i:s'),
                'country' => $delegation->getCountry(),
                'amount_due' => 20,
                'currency' => 'PLN',
            ];
        }

        return new JsonResponse($data);
    }
}
