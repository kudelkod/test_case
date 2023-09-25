# Тестовое задание

## Требования
```
Для запуска проекта необходимо на рабочей машине иметь Docker и docker-compose.
```

## Запуск приложения
```
1) docker-compose up -d 
2) docker-compose exec app composer install 
3) docker-compose exec app composer dump-autoload
4) docker-compose exec app php artisan migrate --seed
5) docker compose exec app php artisan l5-swagger:generat
```

## Описание методов api:
``Приложени доступно по адресу http://localhost:8080/api/``

``Документация по маршрутам http://localhost:8080/api/documentation#/``

```
ВАЖНО!!!
Для авторизации необходимо получить токен из маршрута http://localhost:8080/api/auth/sign_in и вставить в 
Available authorizations
```
