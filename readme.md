<p align="center"><img src="public/images/site-full-logo.png"></p>

*[English](readme.md) | [Русский](readme-ru.md)*

*[Demo](https://devhub.space)*

## Laravel Blog

This is my first app build with Laravel 5.8
> admin: test@gmail.com / 12345678

- CRUD operations to the blog post.
- Creating and Deleting comment for user and blog post.
- Tags for blog post and comment.
- Statistic sidebar on the right side runs on cache (Redis).
- Queues for sending markdown emails (Redis).
- Service "Currently Reading" (App\Services\Counter).
- Localizaton (EN|RU).

## API Laravel Blog

- CRUD operations to the blog post.
- CRUD operation to the blog post comment.

## Tests

- Web App
- API

## Start
 1. Clone this repo into a new directory.
 2. Add **.env** file and set params to connect to your database.
 3. Run `composer install`
 4. Run `npm install` 
 5. Run `php artisan key:generate`
 5. Run `php artisan db:seed`
 6. Update Redis configuration. [Redis Labs](https://redislabs.com/)
 7. Update MailTrap configuration. [MailTrap](https://mailtrap.io/)
 8. Run `php artisan storage:link`
 8. Create database 'laravel-testing' to the tests.
 8. Run `php artisan queue:work --tries=3 --timeout=15 --queue=high,default,low`
 
## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
