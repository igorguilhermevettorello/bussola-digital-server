# bussola-digital-server
Backend desenvolvido em PHP 7.4.9

- git clone git@github.com:igorguilhermevettorello/bussola-digital-view.git
- composer i
- cria arquivo .env com base no .env.example
DB_CONNECTION=mysql
DB_HOST=[host]
DB_PORT=[porta]
DB_DATABASE=[base]
DB_USERNAME=[usuario]
DB_PASSWORD=[senha]

- php artisan migrate
- php -S localhost:8080 -t public