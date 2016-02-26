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


1) Create a dir where you want to create that project, on your taste.


2) Create files for logs [optional - if you don't need this you can skip this step]
You can create dir and files using the following command:

~~~
$ mkdir log
$ touch log/access.log|touch log/error.log
~~~


3) Use composer for get template:
If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
$ php composer global require "fxp/composer-asset-plugin:~1.1.0"
$ git init
$ git clone https://github.com/planet17/yii-app-template.git .


#composer create-project --prefer-dist --stability=dev samdark/yii2-minimal path/to/your/project
~~~


3) Prepare your server.
Add domain to your host. I run my app at my local.
I use it at my:

Ubuntu
Server an Apache >= 2.4 or Nginx >= 1.4
PHP >= 5.6

So as example add domain to my hosts:

Now you should be able to access the application through the following URL, assuming your server webroot is pointed to
`www` directory.

~~~
localhost/
~~~

127.0.0.1	[http://domain.name]

b) Example of my settings for Apache2:

<VirtualHost 127.0.0.1:80>
	DocumentRoot [path-to-the-dir]/www
		<Directory [path-to-the-dir]/www>
			Options Indexes FollowSymlinks
			AllowOverride All
			Require all granted
		</Directory>
	ErrorLog [path-to-the-dir]/log/error.log
	CustomLog [path-to-the-dir]/log/access.log combined
</VirtualHost>

* - About add an ErrorLog and CustomLog is optional, so if you don't create logs dir above

///////////////////////////////////////////////////////////////////////////////

If you want change the name of directory application, its okay. Then you need
1) Rename your directory in the /home/apps/[my_app_name]
2) Change composer json so you need go:
extra > yii\\composer\\Installer::postCreateProject > setPermission & generateCookieValidationKey
and set new path at that

1) Rename your directory
2) Change composer json so you need go:
extra > yii\\composer\\Installer::postCreateProject > setPermission & generateCookieValidationKey
and set new path at that


~~~
$ composer -d=home/yii2 create-project --prefer-dist --stability=dev samdark/yii2-minimal .
$ composer -d=home/yii2 install
$ composer -d=home/yii2 update
~~~

Now setting of permission don\'t work automatically, so you need using the following command:

~~~
chmod 777 home/apps/my_yii2_application/runtime | chmod 777 home/apps/my_yii2_application/runtime
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

**NOTES FROM ME:**
- All command work relatively to root-dir of project. I usually use terminal into my IDE, so I don't need to write a full path.
- Into the apps only one application don't use the database. It is SamDark/Minimal 


**NOTES FROM Sam Dark (Yii2):**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

