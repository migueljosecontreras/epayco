#!/bin/bash
DOCKER_PHP = $(shell basename $(CURDIR))_php_apache_1

init: ## Init the project
	clear
	docker-compose up -d
	docker exec -it ${DOCKER_PHP} composer install
	docker exec -it ${DOCKER_PHP} php artisan key:generate
	#docker cp ${DOCKER_PHP}:/var/www/api/vendor ./
	docker exec -it ${DOCKER_PHP} ./vendor/bin/phpunit
stop:
	clear
	docker-compose stop

run:
	clear
	docker-compose up

ssh: ## ssh's into the PHP container
	clear
	docker exec -it ${DOCKER_PHP} /bin/bash

restart: ## Restart the containers
	make stop
	make run

