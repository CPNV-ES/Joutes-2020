![CPNV joutes logo](https://github.com/CPNV-ES/Joutes/blob/master/wiki/logo-black.png)

# Joutes 2020
This project was carried out in the CPNV. Its main purpose is to help the sports teacher manage the sports games each year.


## Getting started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. If during the installation, you come up with any problems, we have a section at the end of the readme that may help you.

- Git 2.23
- PHP 7.3.9
- Laravel 5.8
- MariaDB 10.4
- Composer 1.9.0
- Node 10.16.3

## Composer
_Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you._

If you don't have composer installed, execute the following commands to do so :

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

## Node

Node.js® is a JavaScript runtime built on Chrome's V8 JavaScript engine. Node.js uses an event-driven, non-blocking I/O model that makes it lightweight and efficient. Node.js' package ecosystem, npm, is the largest ecosystem of open source libraries in the world.

if you don't have node.js installed, you can download it here

We're using node so we can easily manage all of our JavaScript dependencies (gulp, jquery, laravel-elixir). We are aware that using node just for 3 dependencies is a bit overkill, it's something less to worry about. If you wish you can not use node and just download the dependencies.


# Installation

First of all clone the github repository

    $ git clone https://github.com/CPNV-ES/Joutes-2020


Then install all the dependecies

    $ composer install
    $ npm install


Now you need to create the .env file, you just have to copy the .env.exemple

    $cp .env.exemple.env


Once the file is created, you need to generate a new key.

    $ php artisan key:generate


The project is almost up and running, in the .env file you'll need to configure the database information :

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=joutes
    DB_USERNAME=homestead
    DB_PASSWORD=secret

Now you can create the DB

    $php artisan migrate
