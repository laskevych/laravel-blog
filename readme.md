<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Laravel Blog

This is my first app build with Laravel 5.8 

- CRUD operations to the blog post.
- Creating and Deleting comment for user and Blog Post.
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
 2. Add **.env** file
 3. Run `php artisan key:generate`
 4. Run `composer install`
 5. Run `npm install` 
 6. Update Redis configuration. [Redis Labs](https://redislabs.com/)
 7. Update MailTrap configuration. [MailTrap](https://mailtrap.io/)
 8. Create database 'laravel-testing' to the tests.
 8. Run `php artisan queue:work --tries=3 --timeout=15 --queue=high,default,low`
 
## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
