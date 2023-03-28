<?php

// 資料庫設定
// $config['db']['host'] = 'mysql';
// $config['db']['username'] = 'db_user';
// $config['db']['password'] = 'db_pwd';
// $config['db']['dbname'] = 'aidkAdmin';
$config['db']['host'] = getenv('mysql');
$config['db']['username'] = getenv('db_user');
$config['db']['password'] = getenv('db_pwd');
$config['db']['dbname'] = getenv('db_name');

// 預設控制器
$config['defaultController'] = 'Course';
$config['defaultAction'] = 'index';

// 社群登入API
$config['SNS_FB_AppId'] = ''; //FB登入API的APP ID
$config['SNS_FB_Api_Version'] = 'v9.0'; //撰寫時為v9.0，可能需視情況設定v10.0
$config['SNS_Google_Client_Id'] = ''; //Google登入API的Client ID

// 學群設定
$config['courseCategory'] = [
    1 => '生命科學學群',
    2 => '生物資源學群',
    3 => '地球與環境學群',
    4 => '建築與設計學群',
    5 => '藝術學群',
    6 => '社會與心理學群',
    7 => '大眾傳播學群',
    8 => '外語學群',
    9 => '文史哲學群',
    10 => '教育學群',
    11 => '法政學群',
    12 => '管理學群',
    13 => '財經學群',
    14 => '遊憩與運動學群',
    15 => '資訊學群',
    16 => '工程學群',
    17 => '數理化學群',
    18 => '醫藥衛生學群',
    0 => '其他技能',
];

// 授權設定
$config['license'] = [];

return $config;
