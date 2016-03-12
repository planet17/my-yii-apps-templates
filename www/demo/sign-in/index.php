<?php
$pathHome = __DIR__ . '/../../../home';
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require($pathHome . '/myLittleHelper/dir.php');
require($pathHome . '/yii2/vendor/autoload.php');
require($pathHome . '/yii2/vendor/yiisoft/yii2/Yii.php');
$config = require($pathHome . '/apps/planet17/ssi/config/main.php');
(new yii\web\Application($config))->run();