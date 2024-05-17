+ 1:
+ ./env
+ 2:
+ ./blockchaincode/.env
+ 3:
+ docker build -t deepsound-php -f ./docker/Dockerfile .
+ docker build -t sendcoin-nodejs -f ./blockchainsendcoin/Dockerfile ./blockchainsendcoin
+ docker compose -f docker-compose-local.yml up -d
