<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class TeacherModel extends Model
{
    protected $table = 'teacher';

    public function searchTeacher($teacher)
    {
        $sql = "SELECT * FROM `$this->table` WHERE `name` LIKE :keyword OR `account` LIKE :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$teacher%"]);
        $sth->execute();

        return $sth->fetchAll();
    }
}
