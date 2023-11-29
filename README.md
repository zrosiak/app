## metodyki

* ADR
* DDD

* DDD: directory structure (used sensiolabs-de/deptrac to control layers dependencies)

## @TODO

* CQRS
* VO
* testy
* walidacja
* obliczanie kwoty za delegację

## uruchomienie
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
"start":  "2020-04-20 08:00:00",
"end":  "2020-04-21 16:00:00",
"id":  1,
"country":  "PL"
}
```

├── Core (Core bounded context)
│   ├── Application
│   │   ├── Command
│   │   │   ├── AuthToken
│   │   │   ├── Task
│   │   │   └── User
│   │   ├── Query
│   │       └── Task
│   ├── Domain
│   │   └── Model
│   │       ├── Task
│   │       └── User
│   ├── Infrastructure
│   │   └── Repository
│   └── Ports
│       ├── Cli
│       └── Rest
└── Shared
    ├── Domain
    └── Infrastructure
