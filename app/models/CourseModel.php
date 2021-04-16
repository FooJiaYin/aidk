<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class CourseModel extends Model
{
    protected $table = 'course';

    public function getStuCourses()
    {
        $sql = "SELECT a.id AS id, a.name AS name, a.category AS category FROM `course` AS a, `course_bought` AS b WHERE b.user = :user AND a.id = b.course";

        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':user' => $_SESSION['id']]);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getRandomCourse()
    {
        $sql = "SELECT t1.id as id, t1.name, t1.category, t1.description
        FROM `course` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `course`)-(SELECT MIN(id) FROM `course`))+(SELECT MIN(id) FROM `course`)) AS id) AS t2 
        WHERE t1.id >= t2.id 
        ORDER BY t1.id LIMIT 5";
        $sql = "SELECT `id`, `name`, `category`, `description` FROM `course` ORDER BY RAND() LIMIT 5;";

        $sth = Db::pdo()->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function searchCourse($keyword)
    {
        $sql = "SELECT * FROM `$this->table` WHERE `name` LIKE :keyword OR `description` LIKE :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$keyword%"]);
        $sth->execute();

        return $sth->fetchAll();
    }
}
