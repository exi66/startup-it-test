## Запустить
Поменять в `docker-compose.yml` пароль и название базы данных по усмотрению;  
Скопировать `.env-example` в `.env`, заменить `DB_HOST` на название сервиса базы данных в `docker-compose.yml`, по умолчанию `db`, заменить `DB_PASSWORD` на пароль базы данных в `docker-compose.yml`, если поменяли имя базы на прошлом шаге замените и здесь;   
Смонтировать composer в репозиторий `docker run --rm -v $(pwd):/app composer install`;  
Сменить владельца репозитория на `www-data` - `sudo chown -R www-data:root ~/laravel-app`;  
Запустить `docker-compose up -d`;
Сгенерировать ключ `docker-compose exec app php artisan key:generate && docker-compose exec app php artisan config:cache`;  
Запустить миграцию `docker-compose exec app php artisan migrate`;  