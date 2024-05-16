# Welcome to Filapanel

*Brought to you by [Ploi - a server management tool](https://ploi.io/?ref=filapanel-github)*

[https://filapanel.com](https://filapanel.com?ref=filapanel-github)

<p align="center"><a href="https://filapanel.com/?ref=filapanel-github" target="_blank"><img src="https://filapanel.com/img/og.png" width="100%" alt="Filapanel"></a></p>

Generated on: 2024-05-16 01:48:29 (UTC)

Filapanel is your dynamic, user-friendly tool for accelerating Laravel application development. Built on the Filament framework, it provides a seamless approach for creating, configuring, and managing resources and models.

## Installed packages

- [Barryvdh Laravel-Debugbar](https://github.com/barryvdh/laravel-debugbar)

## Further installation

Now that you've got your project, it's time to finish up installation. Please make sure to run the following commands
either in your local project or in your deployment tool.

### Run composer install

```
composer install
```

### Create your `.env`

```
cp .env.example .env
```

Now create a new database and enter the credentials inside your environment file.

### Set your app key

```
php artisan key:generate
```

### Upgrade Filament

```
php artisan filament:upgrade
```

### Run migrations

```
php artisan migrate:fresh
```

### Link storage

```
php artisan storage:link
```

### All as one command

```
composer install && 
cp .env.example .env &&
php artisan key:generate && 
php artisan filament:upgrade &&
php artisan migrate:fresh &&
php artisan storage:link
```
