export UID
export GID

.PHONY = clean test install stop start build composer-install refresh-db

ENVIRON ?= "dev"
COMPOSEFILE = "./environment/$(ENVIRON)/docker-compose.yml"

clean:
	@docker-compose -f ${COMPOSEFILE} down --remove-orphans

build:
	$(info Make: Building environment images.)
	@docker-compose -f ${COMPOSEFILE} up --build --force-recreate -d

start:
	$(info Make: Start docker containers.)
	@docker-compose -f ${COMPOSEFILE} up -d
	@echo 'ok'

stop:
	$(info Make: Stop docker containers.)
	@docker-compose -f ${COMPOSEFILE} stop

composer-install:
	$(info Make: Install composer dependencies.)
	@docker exec -it openrpg-webapp sh -c "composer install -q --no-ansi --no-interaction --no-scripts --no-suggest --no-progress --prefer-dist"

refresh-db:
	$(info Make: Reset & refresh db)
	@docker exec -it openrpg-webapp sh -c "php artisan migrate:fresh && php artisan db:seed"

test:
	$(info Make: Test)
	@docker exec -it openrpg-webapp sh -c "./vendor/bin/phpunit"

install:
	@make -s build
	@make -s composer-install
