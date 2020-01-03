export UID
export GID

ENVIRON ?= "dev"
COMPOSEFILE = "./environment/$(ENVIRON)/docker-compose.yml"

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
	@docker-compose -f ${COMPOSEFILE} run webapp sh -c "composer install"

install:
	@make -s build
	@make -s composer-install