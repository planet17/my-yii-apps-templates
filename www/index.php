<?php // comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../home/yii2/vendor/autoload.php');
require(__DIR__ . '/../home/yii2/vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/../home/apps/my_yii2_application/config/main.php');
(new yii\web\Application($config))->run();
