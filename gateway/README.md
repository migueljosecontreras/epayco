Code Style and Orientations

## Clone

git clone url folder-name --recursive

## Installation

- prepare the .env file
- you must have all MS up and running
- make init
this should exec: 
- docker-compose up -d
- docker cp CONTAINER_NAME:/var/www/api/vendor ./
- docker exec -it CONTAINER_NAME php artisan key:generate
- docker exec -it CONTAINER_NAME php artisan migrate
- docker exec -it CONTAINER_NAME php artisan db:seed

Exec Unit Test: 
- docker exec -it CONTAINER_NAME ./vendor/bin/phpunit

Unit tests: 
Should pass 6 assertions in the next order: 
1-ApiGateway OK
2-Connection with API REST MicroService: OK




===================================
## Language

- Code must be in english

## Migrations

- All migrations must have soft deletes and timestamps, except intermediate tables unless is necessary
- Intermediate tables, singular model names in alphabetical order
- Table column, snake_case
- Foreign key, singular model name with _id suffix
- Primary key, id

## Helpers/Traits/Casts/Rules

- If is a common feature, must be located inside de common folder otherwise it should be placed in the appropriate root folder

## Variables/Functions

- lowerCamelCase

## Route

- Singular
- Use the “-” Symbol

## Controller

- Singular

## Models

- Singular
- Must be saved with the trait secureSave()
- Must be deleted with the trait secureDelete()

## Responses

- Must have placed in ApiResponseTrait
