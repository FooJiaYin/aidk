<?php

namespace app\models;

use libraries\base\Model;
use libraries\db\Db;

class CourseModel extends Model
{
    protected $table = 'course';

    public function getStuCourses()
    {
        $sql = "SELECT a.id AS id, a.name AS name, a.category AS category, a.duration AS duration, a.stuCount as stuCount FROM `course` AS a, `course_bought` AS b WHERE b.user = :user AND a.id = b.course";

        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':user' => $_SESSION['id']]);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getCourseStu($id)
    {
        $criteria = [['gender', 'F'], ['gender', 'M'], 
            ['grade', '1'], ['grade', '2'], ['grade', '3']
        ];
        $sql = "SELECT COUNT(*) AS count FROM `student` AS a, `course_bought` AS b WHERE b.course = :course AND a.id = b.user";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':course' => $id]);
        $sth->execute();
        $info['total'] = $sth->fetch()['count'];
        for($d = 1; $d <= 7; $d += 1) {
            $sql = "SELECT COUNT(*) AS count FROM `student` AS a, `course_bought` AS b WHERE b.course = :course AND a.id = b.user AND DAYOFWEEK(b.bought_time) = :day";
            $sth = Db::pdo()->prepare($sql);
            $sth = $this->formatParam($sth, [':course' => $id]);
            $sth = $this->formatParam($sth, [':day' => $d]);
            $sth->execute();
            $info['day'.strval($d)] = $sth->fetch()['count'];
        }
        foreach($criteria as $c) {
            $sql = "SELECT COUNT(*) AS count FROM `student` AS a, `course_bought` AS b WHERE b.course = :course AND a.id = b.user AND a.".$c[0]." = '".$c[1]."'";
            $sth = Db::pdo()->prepare($sql);
            $sth = $this->formatParam($sth, [':course' => $id]);
            $sth->execute();
            $info[$c[0].$c[1]] = $sth->fetch()['count'];
        }
        return $info;
    }

    public function getCategoryCourses($category, $order)
    {
        $sql = "SELECT * FROM `course` WHERE 
            `category` LIKE :category1  OR 
            `category` LIKE :category2 OR 
            `category` LIKE :category3 OR 
            `category` LIKE :category4 OR
            `category` LIKE :category5
            ORDER BY ".$order;
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':category1' => "[$category]"]);
        $sth = $this->formatParam($sth, [':category2' => "[$category, %"]);
        $sth = $this->formatParam($sth, [':category3' => "%, $category]"]);
        $sth = $this->formatParam($sth, [':category4' => "%, $category, %"]);
        $sth = $this->formatParam($sth, [':category5' => '%"'.$category.'"%']);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getTopCourses($N, $order)
    {
        $sql = "SELECT * FROM `course` ORDER BY ".$order." LIMIT " . $N;
        $sth = Db::pdo()->prepare($sql);
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
