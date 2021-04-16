<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class StudentModel extends Model
{
    protected $table = 'student';

    public function searchStu($stu)
    {
        $sql = "SELECT * FROM `$this->table` WHERE `name` LIKE :keyword OR `account` LIKE :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$stu%"]);
        $sth->execute();

        return $sth->fetchAll();
    }
}
