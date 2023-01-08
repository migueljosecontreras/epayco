Code Style and Orientations
===================================

## Installation

- git clone url folder-name --recursive
- prepare the .env file
- make -f Makefile
this should exec: 
- docker-compose up -d
- docker cp CONTAINER_NAME:/var/www/api/vendor ./
- docker exec -it CONTAINER_NAME php artisan key:generate
- docker exec -it CONTAINER_NAME php artisan queue:table
- docker exec -it CONTAINER_NAME php artisan migrate
- docker exec -it CONTAINER_NAME php artisan db:seed
- generate JWT_SECRET

## Exec Unit Test: 
- docker exec -it CONTAINER_NAME ./vendor/bin/phpunit

- Unit tests: 
Should pass 2 assertions in the next order: 
1- API REST: OK
3- Database Connection: ok 

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

## Rules

- The Foreign keys must have the exists rule, ex. required|integer|exists:table,id

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
