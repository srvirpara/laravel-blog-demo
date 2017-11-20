# laravel-blog-demo
This is a simple laravel blog demo.

* After taking clone first create a database for the project.
* Rename the the .env.example file as .env and setup your enviornment configuration settings there e.g Database details.
* Run `composer install` command from the root directory.(For this command, make sure you have composer installed, https://getcomposer.org/download)
* Run `npm install` command from the root directory.(For this command, make sure you have npm installed, https://docs.npmjs.com/cli/install)
* Now run the commands `php artisan migrate` and then `php artisan db:seed`.
* Run command `php artisan serve` and you can check website from `http://localhost:8000/`.



General guidlines :


Admin URLs :


1) Admin Login URL - http://localhost:8000/admin/login

2) Admin Registration URL : http://localhost:8000/admin/register

Blog Management : 

	3) Blog management : http://localhost:8000/admin/blog

	4) Create blog 	   : http://localhost:8000/admin/create-blog

Blog category management :

	5) Blog category management : http://localhost:8000/admin/blog-category

	6) Create blog category 	: http://localhost:8000/admin/create-blog-category

Blog tags management :	

	7) Blog tags management : http://localhost:8000/admin/blog-tag

	8) Create Blog tags 	: http://localhost:8000/admin/create-blog-tag


Frontend URLs :

Blog listing : http://localhost:8000/blog
