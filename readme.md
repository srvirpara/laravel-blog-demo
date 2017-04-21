# Simple Blog build with Laravel 5.4
This is app used custom Model Factory & Pagination also used Bootstrap.

## Demo
[larablog.hol.es](http://larablog.hol.es)

## How to install
- Clone this repo `git clone https://github.com/ryanrahman26/laravel5.4-blog.git`
- Rename the folder to anything. ex: laravel-blog, and cd to the folder
- Run `composer install` to install dependency
- Copy `.env.example` to `.env`
- Create database `laravel-blog`
- Set `.env`
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
- Run `php artisan key:generate`
- Run database migration & seed `php artisan migrate --seed`
- Run simple php web server `php artisan serve`
- Open the app on `localhost:8000`

## Copyright & license
2017 Ryan Rahman Setiawan. Code under the [MIT license](http://opensource.org/licenses/MIT)