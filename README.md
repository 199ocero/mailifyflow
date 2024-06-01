
# MailifyFlow

An email marketing tool built on top of Laravel, FilamentPHP, Maizzle, and Amazon SES.

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
> ***To track email delivery, bounces, clicks, opens, etc., please ensure you add your AWS key, secret, region, and configuration set name in the .env variable. The system is currently configured only for Amazon SES and if you don't want to track any of this and just want to send emails, you can try adding another SMTP server, but I cannot guarantee it will work. See steps below:***
## Installation

To launch this project in either your local or production environment, specific steps are required.

Clone this repository
```bash
git clone https://github.com/199ocero/mailifyflow.git
```

Install composer and npm
```bash
composer install
npm install
```

Copy `.env.example` into `.env`
```bash
cp .env.example .env
```

Copy `vite.js.example` into `vite.js`
```bash
cp vite.js.example vite.js
```

In your `.env` make sure that you will have to add these variables and its values
```bash
QUEUE_CONNECTION=database
AWS_ACCESS_KEY_ID=your-access-key-id
AWS_SECRET_ACCESS_KEY=your-secret-access-key
AWS_DEFAULT_REGION=your-ses-region
AWS_SES_CONFIGURATION_SET=your-configuration-set-name
```

**Steps below to configure your Amazon SES and SNS:**
 - Set up your Amazon SES to verify your email address and sending domain.
 - Create your `Configuration Sets` and ensure you select all event destinations like sends, hard bounces, complaints, and etc. to track your emails.
 - Create an SNS topic and choose the standard option.
 - Create a subscription within your selected SNS topic, using `HTTPS` as the protocol. You can use `expose` or `ngrok` to expose your local environment; in production, this is not necessary.
 - Use the exposed URL in the `Endpoint` field of your SNS, appending `/webhooks/ses` at the end.

**Steps below create AWS access key, secret access key, and region:**
 - Create an IAM group and assign the `AmazonSESFullAccess` and `AmazonSNSFullAccess` permissions.
 - Create a new IAM user and add them to the group you created.
 - Once the user is created, obtain the access key and secret key, and ensure you use the same region where your Amazon SES is set up.
