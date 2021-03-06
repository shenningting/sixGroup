<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__).'/../');
header('content-type:text/html;charset=utf-8');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../config/common.php');


$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
