<?php if(!in_array(@$_SERVER['REMOTE_ADDR'],['127.0.0.1','::1'])){die('You are not allowed to access this file.');}
defined('YII_DEBUG') or define('YII_DEBUG',true); defined('YII_ENV') or define('YII_ENV','test');
require(__DIR__.'/../home/yii2/vendor/autoload.php'); require(__DIR__.'/../home/yii2/vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__.'/../home/apps/sam-dark/minimal/config/main.php');(new yii\web\Application($config))->run();