## Metodyki

* ADR
* DDD
* CQRS
* Hexagonal Architecture

## Code quality tools
* phpstan
* phpmd
* phpcs
* deptrac

## Uruchomienie
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

## Założenia biznesowe
Implementacja API dla systemu do wyliczania kwoty diet należnej za delegację dla pracownika w firmie X.
* delegacje mogą się odbywać tylko do poniższych krajów, gdzie obowiązują następujące stawki diet za dany dzień:
    * PL: 10 PLN
    * DE: 50 PLN
    * GB: 75 PLN
* data rozpoczęcia delegacji nie może być późniejsza niż data zakończenia delegacji
* jednocześnie pracownik może przebywać tylko na 1 delegacji
* dieta za dzień należy się tylko wtedy, gdy pracownik w danym dniu przebywa minimum 8 godzin w delegacji
* za sobotę i niedzielę nie należy się dieta
* jeśli delegacja trwa więcej niż 7 dni kalendarzowych to wtedy stawka diety za każdy dzień następujący po 7 dniu kalendarzowym jest podwójna

## @TODO

* obliczanie kwoty za delegację