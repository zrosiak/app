<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use Throwable;
use App\Domain\ValueObject\Country;
use App\Application\Request\AddDelegationDto;
use App\Ui\Api\Response\AddDelegationResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Command\AddDelegationCommand;
use App\Application\MessageBus\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Exception\EmployeeNotFoundException;
use App\Domain\Exception\WrongDelegationDateException;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class AddDelegationAction
{
    public function __construct(
        private CommandBusInterface $command_bus,
        private ValidatorInterface $validator,
    ) {}

    public function __invoke(#[MapRequestPayload] AddDelegationDto $dto): Response
    {
        $validation_errors = $this->validator->validate($dto);

        if (count($validation_errors)) {
            return new JsonResponse(['message' => (string) $validation_errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $this->command_bus->dispatch(
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
