DONT TRY IT! ITS NON-FINISHED! Yii 2 Minimal Application Template (RESTRUCTED )
================================

Yii 2 Minimal Application Template is a skeleton Yii 2 application best for
starting totally from scratch.

The template contains the basic features including user login/logout.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

MY TEMPLATE STRUCTURE
-------------------

      home/               !!!!contains console commands (controllers)
      !commands/           contains console commands (controllers)
      !config/             contains application configurations
      !controllers/        contains Web controller classes
      !models/             contains model classes
      !runtime/            contains files generated during runtime
      home/yii2/          especially folder for yii2 framework
      home/yii2/vendor/   contains dependent 3rd-party packages
      !views/              contains view files for the Web application
      www/                contains the entry script and Web resources

DIRECTORY STRUCTURE
-------------------

      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      models/             contains model classes
      runtime/            contains files generated during runtime
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer global require "fxp/composer-asset-plugin:~1.1.0"
composer create-project --prefer-dist --stability=dev samdark/yii2-minimal path/to/your/project
~~~

Now you should be able to access the application through the following URL, assuming your server webroot is pointed to
`project/web` directory.

~~~
http://localhost/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2minimal',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.


So I do that:
mkdir log
touch log/access.log|touch log/error.log


cd home/yii2
composer create-project --prefer-dist --stability=dev samdark/yii2-minimal .
composer install

if you want change the name of directory application, its okay, then you need
1) Rename your directory
2) Change composer json so you need go:
extra > yii\\composer\\Installer::postCreateProject > setPermission & generateCookieValidationKey
and set new path at that
