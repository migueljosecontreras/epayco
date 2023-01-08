#!/bin/bash
DOCKER_PHP = $(shell basename $(CURDIR))_php_apache_1

init: ## Init the project
	clear
	docker-compose up -d
	docker exec -it ${DOCKER_PHP} composer install
	docker exec -it ${DOCKER_PHP} php artisan key:generate
	docker exec -it ${DOCKER_PHP} php artisan migrate
	docker exec -it ${DOCKER_PHP} php artisan db:seed
	#docker cp ${DOCKER_PHP}:/var/www/api/vendor ./
	docker exec -it ${DOCKER_PHP} ./vendor/bin/phpunit
stop:
	clear
	docker-compose stop

run:
	clear
	docker-compose up -d

test:
	clear
	docker exec -it ${DOCKER_PHP} ./vendor/bin/phpunit

ssh:
	clear
	docker exec -it ${DOCKER_PHP} bash

restart:
	make stop
	make run

