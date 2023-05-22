<h1 align="center">Filament dashboard</h1>

#### Репозиторию создал для себя чтобы изучить тонкостей библиотека Filament admin panel. 

## Настройка .env

```shell
cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=filament_dashboard
DB_USERNAME=root
DB_PASSWORD=password

FILAMENT_PATH=""
```

## Начальная установка

```shell
make setup
```

## Команды
### запускает контейнеры
```shell
make start 
```

### отключает контейнеры
```shell
make stop
```

### все короткые команды находятся в файле Makefile

# Логин и пароль для входа в систему
### test@example.com - *Почта*
### password - *Пароль*
