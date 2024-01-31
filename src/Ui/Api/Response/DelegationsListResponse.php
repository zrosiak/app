<?php

declare(strict_types=1);

namespace App\Ui\Api\Response;

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
                'country' => (string) $delegation->getCountry(),
                'amount_due' => $delegation->getAmountDue(),
                'currency' => 'PLN',
            ];
        }

        return new JsonResponse($data);
    }
}
