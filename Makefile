init:
	composer install --no-interaction
	docker compose up -d
	php bin/console d:s:u --force
	php bin/console doctrine:fixtures:load

start:
	symfony server:start --no-tls &
	cd WebSocket && npm start
