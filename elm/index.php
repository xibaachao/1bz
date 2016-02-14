<?php
//项目入口文件
define('APP_NAME','App');

define('APP_PATH','./App/');

define('DOMAIN','http://'.$_SERVER['HTTP_HOST']);

define('APP_DEBUG',true);

define('RUNTIME_PATH','./Cache/');

require './Core/ThinkPHP.php';

