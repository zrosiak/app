<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use Throwable;
use App\Domain\ValueObject\Country;
use App\Ui\Api\Action\AbstractCommandAction;
use App\Application\Request\AddDelegationDto;
use Symfony\Component\HttpFoundation\Request;
use App\Ui\Api\Response\AddDelegationResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Command\AddDelegationCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Exception\EmployeeNotFoundException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Domain\Exception\WrongDelegationDateException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class AddDelegationAction extends AbstractCommandAction
{
    public function __construct(
        private MessageBusInterface $message_bus,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
        parent::__construct($message_bus);
    }

    public function __invoke(Request $request): Response
    {
        $json = $request->getContent();

        try {
            $dto = $this->serializer->deserialize($json, AddDelegationDto::class, 'json');
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $validation_errors = $this->validator->validate($dto);

        if (count($validation_errors)) {
            return new JsonResponse(['message' => (string) $validation_errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $this->dispatch(
                new AddDelegationCommand(
                    $dto->employee_id,
                    $dto->start_date,
                    $dto->end_date,
                    Country::fromString($dto->country),
                )
            );
        } catch (EmployeeNotFoundException) {
            return new JsonResponse(['message' => 'Nie znaleziono pracowanika o podanym id'], JsonResponse::HTTP_NOT_FOUND);
        } catch (WrongDelegationDateException) {
            return new JsonResponse(['message' => 'Pracownik może przebywać jednocześnie w 1 delegacji'], JsonResponse::HTTP_CONFLICT);
        } catch (ValidationFailedException $validation_exception) {
            return new JsonResponse(['message' => (string) $validation_exception->getViolations()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new AddDelegationResponse())();
    }
}
