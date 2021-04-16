<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class LogModel extends Model
{
    protected $table = 'system_log';

    public function writeLog($log)
    {
        $logData = [
            'user' => (isset($_SESSION['id'])) ? $_SESSION['id'] : 0,
            'type' => (isset($_SESSION['loginType'])) ? $_SESSION['loginType'] : 1,
            'log' => $log
        ];

        $this->add($logData);
    }
}
