# KGorod PHP Developer Challenge Environment

Среда для выполнения тестового задания для PHP-разработчика компании «Красивый город».

Для успешного выполнения задания вам потребуется знание следующих технологий:
- PHP 7.2;
- Yii2;
- Composer;
- Docker;
- Codeception;
- GitLab.

Для выполнения задания: 
- сделайте [форк проекта](https://gitlab.com/kgorod-public-projects/kgorod-php-developer-challenge/-/forks/new);
- разверните среду выполнения с конфигурацией в прилагаемом файле `docker-compose.yml`;
  
> ##### Примечание
> Для настройки среды используйте указания, содержащиеся в файле [README.md шаблона пакета](yii2-kg-developer-challenge/README.md).

- выполните указанные в настоящем документе задания; 
- создайте коммит с изменениями в свой форк проекта;
- сделайте мерж-реквест в исходный проект;
- ссылку на мерж-реквест отправьте проверяющему.

## Суть задания
В каталоге yii2-kg-developer-challenge содержится шаблон пакета Yii2 для выполнения тестового задания.

Реализовать три обязательных публичных метода в классе `src/PublicApi/DeveloperChallengeApi`. Входные данные — таблицы `orders` и `order_items` (миграции нужны).

## Требуемые методы (в DeveloperChallengeApi)
1. `getOrderSummary(int $orderId): array`  
   - Возвращает массив с ключами:  
     - **`order_id`** — идентификатор заказа (`orders.id`).  
     - **`user_id`** — идентификатор пользователя (`orders.user_id`).  
     - **`created_at`** — дата/время создания заказа (`orders.created_at`), Unix timestamp.  
     - **`total_from_items`** — сумма по позициям заказа: `SUM(quantity * unit_price)` по `order_items` для данного `order_id`; возвращать с точностью до 2 знаков (число или строка '123.45'), единообразно в ответе.  
     - **`total_from_orders`** — значение поля `orders.total` из таблицы `orders` (заявленная итоговая сумма заказа); возвращать с точностью до 2 знаков.  
     - **`items_count`** — количество позиций в заказе (`COUNT(*)` по `order_items` для данного `order_id`).  
     - **`price_diff`** — разница: `total_from_orders - total_from_items`, округлённая до 2 знаков. 

2. `listOrdersByUser(int $userId, int $limit = 10): array` 
   - Возвращает массив заказов пользователя (до `$limit`). Для каждого заказа вернуть:  
     - **`order_id`** — `orders.id`.  
     - **`user_id`** — `orders.user_id`.  
     - **`created_at`** — `orders.created_at`.  
     - **`total_from_orders`** — поле `orders.total` (заявленная итоговая сумма).  
     - **`items_count`** — количество позиций в заказе (`COUNT(*)` по `order_items`).  

3. `calculateOrderTaxes(int $orderId, float $taxRate): array`  
   - Возвращает массив с ключами:  
     - **`order_id`** — `orders.id`.  
     - **`subtotal`** — то же, что `total_from_orders` (`SUM(quantity * unit_price)` по позициям), с точностью до 2 знаков.  
     - **`tax_rate`** — значение `$taxRate`, как передано (например, `0.20` для 20%).  
     - **`tax_amount`** — налог, вычисляемый как `round(subtotal * tax_rate, 2)`.  
     - **`total_with_tax`** — `subtotal + tax_amount`, округлённое до 2 знаков.  

Все три метода обязательны и должны возвращать plain arrays.

## Требуемые артефакты
- Миграции в `src/Migrations/` (Yii2 migration) для создания таблиц.
- Реализованный `src/PublicApi/DeveloperChallengeApi` с тремя методами (см. выше).
- Тесты Codeception (`tests/`), покрывающие корректность вычислений и поведение методов.

> ##### Примечание
> Примеры команд для генерации миграций и моделей и выполнения тестов приводятся в файле [README.md шаблона пакета](yii2-kg-developer-challenge/README.md).

> ##### Примечание
> Пример теста Codeception приводится в файле [ExampleTest.php](yii2-kg-developer-challenge/tests/acceptance/ExampleTest.php).

## Ограничения и требования к реализации
- Репозитории возвращают только массивы (по строкам таблиц).
- Бизнес-логика (агрегации, расчёты, формирование итоговых структур) находится в сервисах и принимает массивы из репозиториев. Любые обращения к базе данных с уровня бизнес-логики не допускаются.
- Не использовать JOIN в SQL.
- PublicApi — только публичные классы; внутренние — вне PublicApi.
- Не добавлять ненужных зависимостей.
- Публичные методы возвращают массивы (ActiveRecord наружу не отдаем).
