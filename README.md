## About
A simple applicant tracking system for easily manage by the recruiter and frontend where job seeker can apply.

### Planning and working
- [Dropbox Paper](https://www.dropbox.com/scl/fi/xizllobyjoth8l2k0o61w/Overview_-SimplyATS.paper?dl=0&rlkey=yn8s5inyj8y5v889jdmrxe9di) Project overview
- [Trello board](https://trello.com/b/oI3vllGH/simplyats) to manage the task
- [Postman](https://documenter.getpostman.com/view/13045202/UV5dcZTW#ec159e40-7b09-4a12-84ae-a743a6645fac) for API documentation

### Requirements
To run this application you need to have:
- PHP Version: `^8.0`
- Exif PHP Extension
- GD PHP Extension
- Imagick PHP Extension
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Fileinfo PHP extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- [Redis](https://pecl.php.net/package/redis)

Nice to have [MKCert](https://github.com/FiloSottile/mkcert) for https local development.


### Official and third-party libraries
List of used packages:

- [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum) for SPA authentication.
- [Laravel IDE Helper Generator](https://github.com/barryvdh/laravel-ide-helper) to generate accurate autocompletion.
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to enforces everybody is using the same coding standard
- [Laravel Telescope](https://laravel.com/docs/8.x/telescope) provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps, and more.
- [Predis](https://github.com/predis/predis) A flexible and feature-complete Redis client for PHP.
- [Laravel Media Library](https://github.com/spatie/laravel-medialibrary) Associate files with Eloquent models.
- [Laravel Enum](https://github.com/BenSampo/laravel-enum) Simple, extensible and powerful enumeration implementation for Laravel.
- [flysystem aws s3](https://github.com/thephpleague/flysystem-aws-s3-v3) Flysystem Adapter for AWS SDK V3


### PSR2 Coding Standard

You can now run the test simply typing
<pre><code>./vendor/bin/phpcs</code></pre>
Fixing PHP CodeSniffer has built-in tool that can fix a lot of the style errors, you can fix your code by simply typing
<pre><code>./vendor/bin/phpcbf</code></pre>

The test directory is ignore in the `phpcs.xml` since I choose `snake_case` over `CamelCase` in the class methods for readability purpose.

You can read [here](https://laravel.com/docs/master/contributions#coding-style)

### Getting Started
Clone the repository
```
$ git clone git@github.com:markmarilag27/laravel-simplyats.git
```
Copy and edit environment file
```
$ cp .env.example .env
```
Run docker compose to build and run services
```
$ docker-compose up -d
```
Create local bucket on minion or config aws s3 bucket
```
Open http://minio:9000
```
Install dependencies
```
$ composer install
```
Generate key
```
$ php artisan key:generate
```
Install telescope
```
php artisan telescope:install
```
Run the migration and seed for john.doe@laravel.com password
```
$ php artisan migrate --seed
```
To generate 100,000 jobs
```
$ php artisan db:seed --class=JobSeeder
```
To generate 100,000 applicants
```
$ php artisan db:seed --class=ApplicantSeeder
```
To generate applicant CV
```
$ php artisan db:seed --class=CVSeeder
```
### Test
To make sure everything does not break run the test
```
$ php artisan test
```
