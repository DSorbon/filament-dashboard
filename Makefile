export

DC := docker compose exec
PHP := $(DC) php
ARTISAN := $(PHP) php artisan
NODE := $(DC) node

build:
	@docker compose build --no-cache

compose-up:
	@docker compose up -d

start: compose-up serve

stop:
	@docker compose stop

restart: stop start

setup: compose-up composer-install migrate seed serve

composer-install:
	@$(PHP) composer install

serve:
	@$(ARTISAN) serve --host=0.0.0.0

keygen:
	@$(ARTISAN) key:generate

clear:
	@$(ARTISAN) optimize:clear

cache-clear:
	@$(ARTISAN) cache:clear

view-clear:
	@$(ARTISAN) view:clear

fresh:
	@$(ARTISAN) migrate:fresh

migrate:
	@$(ARTISAN) migrate

rollback:
	@$(ARTISAN) migrate:rollback

seed:
	@$(ARTISAN) db:seed

ssh:
	@$(PHP) bash

ssh-node:
	$(DC) node bash

node-install:
	$(NODE) npm install

node-dev:
	$(NODE) npm run dev
