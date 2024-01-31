## Architecture

* ADR
* DDD
* CQRS
* Hexagonal Architecture

## Code quality tools
* phpstan
* phpmd
* phpcs
* deptrac

## Setup
`docker-compose up -b`

`docker exec -it php bash`

`composer install`

`php bin/console doctrine:migrations:migrate`

## API

* /api/delegations-list/{id} [GET]
* /api/create-employee [POST]
* /api/add-delegation [POST]
```json
{
    "start_date": "2020-05-21 16:00:00",
    "end_date": "2020-05-22 16:00:00",
    "employee_id": 4,
    "country": "PL"
}
```

## Business logic
Implementation of an API for a system that calculates the amount of per diem allowance for an employee's business trip in company X.
* business trips can only be made to the following countries, where the following per diem rates apply for each day:
    * PL: 10 PLN
    * DE: 50 PLN
    * GB: 75 PLN
* the start date of the trip cannot be later than the end date
* an employee can only be on one business trip at a time
* a per diem allowance is only granted for a day when the employee spends a minimum of 8 hours on the trip
* per diem allowance is not granted for Saturdays and Sundays
* if the trip lasts more than 7 days, the per diem rate for each day after the 7th day is doubled
