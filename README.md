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
_Composer_ is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

If you don't have _Composer_ installed, execute the following commands to do so :

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## Node

Node.js is a JavaScript runtime built on Chrome's V8 JavaScript engine. Node.js uses an event-driven, non-blocking I/O model that makes it lightweight and efficient. Node.js' package ecosystem, _NPM_, is the largest ecosystem of open source libraries in the world.

If you don't have Node.js installed, you can download it [here](https://nodejs.org/).

We're using Node so we can easily manage all of our JavaScript dependencies (Gulp, JQuery, Laravel-Elixir). We are aware that using Node just for 3 dependencies is a bit overkill, it's something less to worry about. If you wish you can not use node and just download the dependencies.


# Installation

**As an alternative, you can set up the project with Docker. See instructions below.**

First of all, clone the GitHub repository

```bash
$ git clone https://github.com/CPNV-ES/Joutes-2020
```

Then, install all the dependencies

```bash
$ cd Joutes-2020
$ composer install
$ npm install
```

Now, you need to create the .env file. You just have to copy the .env.exemple

```bash
$ cp .env.example .env
```

Once the file is created, you need to generate a new key

```bash
$ php artisan key:generate
```


The project is almost up and running. In the .env file you'll need to configure the database information

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=joutes
    DB_USERNAME=[PUT YOUR USERNAME HERE]
    DB_PASSWORD=[PUT YOUR PASSWORD HERE]

Create the database

    DROP DATABASE IF EXISTS joutes;
    CREATE DATABASE joutes;

**Note: DO NOT use an external program (e.g. Workbench) to synchronize the database model.**

Finally, seed the DB

```bash
$ php artisan migrate
$ php artisan db:seed
```

## Dev login
In order to be logged as a developper, run this command
```bash
    php artisan make:devLogin <username>
```

# Docker

## Set up

Docker allows you to develop without needing to have PHP or Composer installed on your host environment.

All you need to do is to install Docker **and** Docker Compose. [Check the official documentation for instructions.](https://docs.docker.com/)

## Make the containers work

The instructions to get a container up and running is very similar to how you would do it *normally*.

Make sure to have a `.env` file in the root of the project because it will get copied. Just use the `.env.example` file and rename it. You don't need to change anything.

```bash
# Note that you may (or may not) need to run the commands as sudo depending on your configuration.

# You do not need to pass the --build argument if you didn't change the Dockerfile.
sudo docker-compose up -d --build

sudo docker-compose exec web composer install

sudo docker-compose exec web npm install

sudo docker-compose exec web php artisan key:generate

sudo docker-compose exec web php artisan config:cache

sudo docker-compose exec web php artisan migrate

sudo docker-compose exec web php artisan db:seed

sudo docker-compose exec web npm run watch
```

When you are done for the day, it is recommended that you run `sudo docker-compose down`. When you want to start the project again, run `sudo docker-compose up`.