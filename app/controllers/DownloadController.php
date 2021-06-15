<?php

namespace app\controllers;

use app\models\CourseModel;
use app\models\CourseBoughtModel;
use app\models\AssignmentModel;
use app\models\StudentModel;

use libraries\base\Controller;
use libraries\base\Authorization as auth;
use libraries\base\Common;

class DownloadController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }
    
    public function hw($id = null) {        
        $hw = (new AssignmentModel)->where(['id = :id'], [':id' => $id])->fetch();
        $stu = (new StudentModel)->where(['id = :id'], [':id' => $hw['user']])->fetch();
        $course = (new CourseModel)->where(['id = :id'], [':id' => $hw['course']])->fetch();
        if(isset($_SESSION['isLogin'])) {
            if($_SESSION['loginType'] == 3 || ($_SESSION['loginType'] == 2 && $_SESSION['id'] == $course['teacher'])) {
                $hw = (new AssignmentModel)->where(['id = :id'], [':id' => $id])->fetch();                
                $filename = explode('.', $hw['name']);
                $file_ext = end($filename);
                $filename = $hw['course'] . '_' . $hw['user'] . '_' . $hw['id'] . '.' . $file_ext;
                $filepath = "./course_data/" . $hw['course'] . '/hw/' . $filename;
                $date = str_replace('-', '', substr($hw['uploaded_time'], 0, 10));
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='. $stu['name'] . '_' . $hw['name']);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                readfile($filepath);
                exit;
            }
        }
    }
}