<?php
// 定義根目錄
define('APP_PATH', __DIR__ . '/');

// 除錯模式
define('APP_DEBUG', true);

// 載入框架
require(APP_PATH . 'libraries/Core.php');

// 載入設定
$config = require(APP_PATH . 'config/config.php');

date_default_timezone_set('Asia/Taipei');

// 啟動Session
session_start();

// 實體化框架
(new libraries\Core($config))->run();
