build:
	docker build -t deepsound-php -f ./docker/Dockerfile .
	docker build -t sendcoin-nodejs -f ./blockchainsendcoin/Dockerfile ./blockchainsendcoin
config:
	
start:
	docker compose -f docker-compose-local.yml down
	docker compose -f docker-compose-local.yml up -d
stop:
	docker compose -f docker-compose-local.yml down

# Checker
cmd-sendcoin:
	docker run -it --rm sendcoin-nodejs /bin/bash