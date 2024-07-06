### Setup in local

Go to your root folder of your server whatever server apache/nginx and follow below steps

1. git clone https://github.com/itcoders-solutions/laravel-base-template.git
2. cd laravel-base-template
3. composer install
4. cp .env.example .env
5. Change the database details in env for the project
6. php artisan key:generate
7. php artisan migrate
8. php artisan db:seed
9. php artisan serve



### Helpfull commands

Before start the work make your own branch

1. git branch // show all branch include current
2. git branch develop-devanshi
3. git checkout develop-devanshi
4. ALl Done
