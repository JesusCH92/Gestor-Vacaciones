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

##    start:			starts web server containers (nginx + PHP fpm)
.PHONY : start
start: create-network
	@docker-compose up -d

##    stop:			stops webserver containers
.PHONY : stop
stop: 
	@docker-compose -f docker-compose.yml stop

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


