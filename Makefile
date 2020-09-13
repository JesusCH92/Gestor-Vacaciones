all: help

##  _            ____        _ _
## | |    __ _  / ___|  __ _| | | ___
## | |   / _` | \___ \ / _` | | |/ _ \
## | |__| (_| |  ___) | (_| | | |  __/
## |_____\__,_| |____/ \__,_|_|_|\___|

.PHONY : help
help : Makefile
	@sed -n 's/^##\s//p' $<
	
SHELL := /bin/bash
ROOT_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
UID=$(shell id -u)

define docker_phpcli_run
	docker-compose -f docker-compose.cli.yml run \
		--rm \
		--no-deps \
		--entrypoint=/bin/bash \
		-e HOST_USER=${UID} \
		-e TERM=xterm-256color \
		php-cli -c "$1"
endef

##    create-network:		creates the default network
.PHONY : create-network
create-network:
	-@docker network create lasalle_network

##    start:			starts web server containers (nginx + PHP fpm + MySQL)
.PHONY : start
start: create-network
	@docker-compose -f docker-compose.yml -f docker-compose.db.yml up -d

##    stop:			stops webserver containers
.PHONY : stop
stop: 
	@docker-compose -f docker-compose.yml -f docker-compose.db.yml stop

## ! deploy project by environment dev-> up environment + clear cache + install dependencies + migration database
.PHONY : deploy@dev
deploy@dev: create-network
	@docker-compose -f docker-compose.yml -f docker-compose.db.yml up -d
	-@$(call docker_phpcli_run,php bin/console cache:clear -e dev);
	-@$(call docker_phpcli_run,php bin/console cache:warmup -e dev);
	-@$(call docker_phpcli_run,composer install --no-interaction) ;
	-@$(call docker_phpcli_run,php bin/console doctrine:database:drop --force -e dev);
	-@$(call docker_phpcli_run,php bin/console doctrine:database:create --if-not-exists -e dev);
	-@$(call docker_phpcli_run,php bin/console doctrine:migrations:migrate --no-interaction -e dev);
	
## ! deploy project by environment prod-> up environment + clear cache + install dependencies + migration database
.PHONY : deploy
deploy: create-network
	@docker-compose -f docker-compose.yml -f docker-compose.db.yml up -d
	-@$(call docker_phpcli_run,php bin/console cache:clear -e prod);
	-@$(call docker_phpcli_run,php bin/console cache:warmup -e prod);
	-@$(call docker_phpcli_run,composer install --no-interaction) ;
	-@$(call docker_phpcli_run,php bin/console doctrine:database:drop --force -e prod);
	-@$(call docker_phpcli_run,php bin/console doctrine:database:create --if-not-exists -e prod);
	-@$(call docker_phpcli_run,php bin/console doctrine:migrations:migrate --no-interaction -e prod);

## ! Clear cacher for dev environment
.PHONY : clear-cache@dev
clear-cache@dev:
	-@$(call docker_phpcli_run,php bin/console cache:clear -e dev);

## ! Clear cacher for prod environment
.PHONY : clear-cache
clear-cache:
	-@$(call docker_phpcli_run,php bin/console cache:clear -e prod);


## ! Install dependencies with composer
.PHONY : install
install:
	-@$(call docker_phpcli_run,composer install --no-interaction) ;

## ! Run php unit test
.PHONY : php-test
php-test:
	-@$(call docker_phpcli_run,php bin/phpunit --testdox);

##    remove:			stops all containers and delete them
.PHONY : remove
remove:
	@docker-compose -f docker-compose.yml rm -s -f

##    logs:			shows all containers logs
.PHONY : logs
logs:
	@docker-compose -f docker-compose.yml logs -f -t

##    logs@php:			just shows PHP fpm logs
.PHONY : logs@php
logs@php:
	@docker-compose -f docker-compose.yml logs -f -t php-fpm

##    interactive:			runs a container with an interactive shell
.PHONY : interactive
interactive: create-network
	-@docker-compose -f docker-compose.cli.yml run \
		--rm \
		--no-deps \
		-e HOST_USER=${UID} \
		-e TERM=xterm-256color \
		php-cli /bin/zsh -l


