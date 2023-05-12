<h1 align="center">Filament dashboard</h1>

## Начальная установка

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## Настройка .env

```shell
cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=filament_dashboard
DB_USERNAME=sail
DB_PASSWORD=password

FILAMENT_PATH=""
```

## Запуск

```shell
./vendor/bin/sail up -d
```

```shell
./vendor/bin/sail artisan key:generate
```
