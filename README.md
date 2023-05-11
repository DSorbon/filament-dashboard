<h1 align="center">Filament dashboard</h1>

## Установка

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## Запуск

```shell
./vendor/bin/sail up
```
