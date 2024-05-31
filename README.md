
# MailifyFlow

An email marketing tool built on top of Laravel, FilamentPHP, and Maizzle.


## Acknowledgements

A special acknowledgment goes to these remarkable tools, as MailifyFlow owes its existence to their invaluable contribution.

- [Laravel](https://laravel.com/)
- [FilamentPHP](https://filamentphp.com/)
- [Maizzle](https://maizzle.com/)
- [Filapanel](https://filapanel.com/)


## Requirements
- PHP 8.2+
- Node v20.3.1+
- Composer v2.7.6+

> [!IMPORTANT]
> ***To track email delivery, bounces, clicks, opens, etc., please ensure you add your AWS key, secret, and region in the .env variable. The system is currently configured only for AWS SES and if you don't want to track any of this and just want to send emails, you can try adding another SMTP server, but I cannot guarantee it will work. See steps below:***
## Installation

To launch this project in either your local or production environment, specific steps are required.

Clone this repository
```bash
git clone https://github.com/199ocero/mailifyflow.git
```

Install composer and packages
```bash
composer install
npm install
```

Copy .env.example into .env
```bash
cp .env.example .env
```

Copy vite.js.example into vite.js
```bash
cp vite.js.example vite.js
```

