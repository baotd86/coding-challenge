# Fram^ Coding Challenge

## Setup docker and docker compose
Please follow these tutorial to set up docker
https://docs.docker.com/desktop/
## Setup application

```shell
cd 
copy .env.example .env
```

```shell
docker compose up -d
docker compose exec app composer install
docker compose exec app composer dump-autoload
```

## Run Unit Test

```shell
docker compose exec app vendor/bin/phpunit
```

## Test API with postman

Please use postman file [here](./Fram_API_Test.postman_collection.json)

## Troubleshoot

If application cannot loaded after run command `docker compose exec app composer install`. Please run these commands

```shell
cd /coding-challenge
composer install
docker compose exec app composer update
```
And check
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
