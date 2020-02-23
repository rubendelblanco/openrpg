export UID
export GID

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

django-install:
	$(info Make: Install django deps)
	@docker-compose -f ${COMPOSEFILE} run django install

refresh-db:
	$(info Make: Reset & refresh db)
	@docker exec -it openrpg-webapp sh -c "php artisan db:flush && php artisan migrate && php artisan db:seed"

test:
	$(info Make: Test)
	@docker exec -it openrpg-webapp sh -c "./vendor/bin/phpunit"

install:
	@make -s build
	@make -s composer-install
	@make -s django-install