<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Employee;

final class EmployeeFactory
{
    public function create(): Employee
    {
        return new Employee();
    }
}
