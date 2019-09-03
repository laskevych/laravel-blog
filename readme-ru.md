<p align="center"><img src="public/images/site-full-logo.png"></p>

*[English](readme.md) | [Русский](readme-ru.md)*

## Laravel Blog

Мое первое приложение на Laravel 5.8 

- CRUD операции с блог постами.
- Создание и удаление комментариев для пользователя и поста.
- Теги для комментариев и постов.
- Сайдбар со статиской. (Redis).
- Очереди для отправления эмейлов (Redis).
- Сервис "Сейчас читают/просматривают" (App\Services\Counter).
- Локализация (EN|RU).

## API Laravel Blog

- CRUD для блог постов.
- CRUD для комментариев блог постов.

## Tests

- Web App
- API

## Start
 1. Clone this repo into a new directory.
 2. Add **.env** file
 3. Run `composer install`
 4. Run `npm install` 
 5. Run `php artisan key:generate`
 6. Update Redis configuration. [Redis Labs](https://redislabs.com/)
 7. Update MailTrap configuration. [MailTrap](https://mailtrap.io/)
 8. Run `php artisan storage:link`
 8. Create database 'laravel-testing' to the tests.
 8. Run `php artisan queue:work --tries=3 --timeout=15 --queue=high,default,low`
 
## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
