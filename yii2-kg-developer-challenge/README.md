# Yii2 Kg Developer Challenge
Тестовое задание для PHP-Backend-разработчика.

## Настройка среды разработки
1. Установить зависимости:
```sh
docker-compose exec -w/app/yii2-kg-developer-challenge app composer install
```
2. Скопировать файл `test-config-local.example.php` в `test-config-local.php` и внести в него требуемые изменения.


## Тестирование
```sh
docker-compose exec -w/app/yii2-kg-developer-challenge app ./vendor/bin/codecept run
```
## Gii

### Генерация модели
```sh
docker-compose exec -w/app/yii2-kg-developer-challenge app php tests/bin/yii gii/model --tableName=some_table --modelClass=SomeClass --ns="KGorod\\DeveloperChallenge\\Models" --generateRelations=none --useTablePrefix=1 --generateRelationsFromCurrentSchema=0 --generateQuery=1 --queryNs="KGorod\\DeveloperChallenge\\Models\\Queries" --queryClass=SomeQueryClass --template=default
```
> ##### Примечание
> В среде Windows замените сдвоенные слеши на одинарные.

## Миграции
### Создание миграции
```sh
docker-compose exec -w/app/yii2-kg-developer-challenge app php tests/bin/yii migrate/create KGorod\\DeveloperChallenge\\Migrations\\<migration_name> --fields="..."
```

> ##### Примечание
> В среде Windows замените сдвоенные слеши на одинарные.

### Выполнение миграции
```sh
docker-compose exec -w/app/yii2-kg-developer-challenge app php tests/bin/yii migrate
```
