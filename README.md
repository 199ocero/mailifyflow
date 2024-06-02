
# MailifyFlow

An open-source, self-hosted email marketing platform built using Laravel, FilamentPHP, Maizzle, and Amazon SES.

## Acknowledgements

A special acknowledgment goes to these remarkable tools, as MailifyFlow owes its existence to their invaluable contribution.

- [Laravel](https://laravel.com/) - favorite PHP framework
- [FilamentPHP](https://filamentphp.com/) - my go-to admin panel
- [Maizzle](https://maizzle.com/) - turn TailwindCSS to email ready html/css
- [Filapanel](https://filapanel.com/) - admin panel generation
- [SendPortal](https://github.com/mettle/sendportal) - highly inspired by SendPortal

## Features

- Bulk insert subscribers
- Tags
- Campaigns
- Templates
- Email Providers (SMPT)
- Email tracking like bounce, complaint, clicks, opens, etc.


## Tech Stack

TailwindCSS, Alpine.js, Laravel, and Livewire (TALL)


## Requirements
- Laravel 11+
- PHP 8.2+
- Node v20+
- Composer v2.7+
## Installation

Follow these steps to set up this project in your local or production environment.

Clone the repository:
```bash
git clone https://github.com/199ocero/mailifyflow.git
```

Navigate to the cloned project directory and install composer and npm:
```bash
composer install
npm install
```

Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```

Copy the `vite.js.example` file to `vite.js`:
```bash
cp vite.js.example vite.js
```

Configure your database settings in the `.env` file: 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mailifyflow
DB_USERNAME=your-mysql-username
DB_PASSWORD=your-mysql-password
```

Run the database migrations:
```bash
php artisan migrate
```

Create your first user:
```bash
php artisan make:filament-user
```

> [!IMPORTANT]
> ***To track email delivery, bounces, clicks, opens, etc., please ensure you add your AWS key, secret, region, and configuration set name in the .env variable. The system is currently configured only for Amazon SES and if you don't want to track any of this and just want to send emails, you can try adding another SMTP server, but I cannot guarantee it will work. See steps below:***

In your `.env` make sure that you will have to add these variables and its values
```bash
QUEUE_CONNECTION=database
AWS_ACCESS_KEY_ID=your-access-key-id
AWS_SECRET_ACCESS_KEY=your-secret-access-key
AWS_DEFAULT_REGION=your-ses-region
AWS_SES_CONFIGURATION_SET=your-configuration-set-name
MAILIFYFLOW_NODE_PATH=full-path-to-your-node
```

**Steps below to configure your Amazon SES and SNS:**
 - Set up your Amazon SES to verify your email address and sending domain.
 - Create your `Configuration Sets` and ensure you select all event destinations like sends, hard bounces, complaints, and etc. to track your emails.
 - Create an SNS topic and choose the standard option.
 - Create a subscription within your selected SNS topic, using `HTTPS` as the protocol. You can use `expose` or `ngrok` to expose your local environment; in production, this is not necessary.
 - Use the exposed URL in the `Endpoint` field of your SNS, appending `/webhooks/ses` at the end.

> [!IMPORTANT]
> ***Please ensure that you do not disable or cancel your `expose` or `ngrok`, as it needs to listen to all events coming from Amazon SNS. During development, it's crucial to keep it running, but in production, you can turn it off.***

**Steps below create AWS access key, secret access key, and region:**
 - Create an IAM group and assign the `AmazonSESFullAccess` and `AmazonSNSFullAccess` permissions.
 - Create a new IAM user and add them to the group you created.
 - Once the user is created, obtain the access key and secret key, and ensure you use the same region where your Amazon SES is set up.

Lastly, the system uses jobs, so you will need to run `php artisan queue:work` for the local environment. For production, you will need to use a tool like `supervisor` and Laravel provides [documentation](https://laravel.com/docs/11.x/queues#running-the-queue-worker) for this. Additionally, the system having scheduled commands and you need to setup your server using the provided [guide.](https://laravel.com/docs/11.x/scheduling#running-the-scheduler)

## Authors

- [Jay-Are Ocero](https://github.com/199ocero)
- [All Contributors](https://github.com/199ocero/mailifyflow/graphs/contributors)

## Contributing

Contributions are always welcome!

See `contributing.md` for ways to get started.

Please adhere to this project's `code of conduct`.


## Questions

If you have any questions, please reach out to freelanceocero@gmail.com


## License

[GNU GPLv3](https://choosealicense.com/licenses/gpl-3.0/)

