<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class SchoolModel extends Model
{
    protected $table = 'school';

    public function getDistinct($column)
    {
        // $sql = "SELECT DISTINCT :column";
        $sql = "SELECT DISTINCT " . $column . " FROM school";
        $sth = Db::pdo()->prepare($sql);
        // $sth = $this->formatParam($sth, [':column' => $column]);
        $sth->execute();
        return $sth->fetchAll();
    }
}
