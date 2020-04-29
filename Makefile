up: docker-up
init: docker-down-clear docker-pull docker-build docker-up pocket-init
test: pocket-test

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

pocket-init: pocket-composer-install pocket-wait-db pocket-migrations

pocket-composer-install:
	docker-compose run --rm pocket-php-cli composer install

pocket-wait-db:
	until docker-compose exec -T pocket-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1; done

pocket-migrations:
	docker-compose run --rm pocket-php-cli php bin/console doctrine:migrations:migrate --no-interaction

pocket-test:
	docker-compose run --rm pocket-php-cli php bin/phpunit

build-production:
	docker build --pull --file=pocket/docker/production/nginx.docker --tag ${REGISTRY_ADDRESS}/pocket-nginx:${IMAGE_TAG} pocket
	docker build --pull --file=pocket/docker/production/php-fpm.docker --tag ${REGISTRY_ADDRESS}/pocket-php-fpm:${IMAGE_TAG} pocket
	docker build --pull --file=pocket/docker/production/php-cli.docker --tag ${REGISTRY_ADDRESS}/pocket-php-cli:${IMAGE_TAG} pocket
	docker build --pull --file=pocket/docker/production/postgres.docker --tag ${REGISTRY_ADDRESS}/pocket-postgres:${IMAGE_TAG} pocket

push-production:
	docker push ${REGISTRY_ADDRESS}/pocket-nginx:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/pocket-php-fpm:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/pocket-php-cli:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/pocket-postgres:${IMAGE_TAG}

deploy-production:
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'rm -rf docker-compose.yml .env'
	scp -o StrictHostKeyChecking=no -P ${PRODUCTION_PORT} docker-compose-production.yml ${PRODUCTION_HOST}:docker-compose.yml
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "REGISTRY_ADDRESS=${REGISTRY_ADDRESS}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_APP_SECRET=${MANAGER_APP_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_DB_PASSWORD=${MANAGER_DB_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose pull'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose --build -d'