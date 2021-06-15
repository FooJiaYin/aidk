<?php

namespace app\controllers;

use libraries\base\Controller;
use libraries\base\Authorization as auth;

use app\models\TeacherModel;
use app\models\LogModel;
use app\models\CourseModel;
use app\models\CourseBoughtModel;
use app\models\AssignmentModel;
use app\models\StudentModel;

class TeacherController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        if ((isset($_SESSION['isLogin']) && is_bool($_SESSION['isLogin']) && $_SESSION['isLogin'])) {
            $user = (new TeacherModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
        } else {
            $user = null;
        }


        $this->assign('user', $user);
    }

    public function index()
    {
        header("Location: /teacher/courseList/");
        exit();
    }

    // 使用者登入介面
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = $_POST['account'];
            $password = $_POST['password'];

            $teacher = (new TeacherModel)->where(['account = :account'], [':account' => $account])->fetch();

            if ($teacher && auth::doLogin($teacher, $password, 2)) {
                (new LogModel)->writeLog("老師登入(帳號: $account)");
                header("Location: /teacher/courseList/");
            } else {
                (new LogModel)->writeLog("老師登入失敗(帳號: $account, 帳密錯誤)");
                header("Location: /teacher/login/");
            }
            exit();
        } else {
            $this->render();
        }
    }

    // 使用者登入介面
    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit();
    }

    public function profile()
    {
        if (auth::checkAuth(true, 'TEACHER')) {
            $this->render();
        } 
    }

    public function profileEdit()
    {
        if (auth::checkAuth(true, 'TEACHER')) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $teacher = [
                    'name' => $_POST['name'],
                    'gender' => $_POST['gender'],
                    'email' => $_POST['email']
                ];
                (new TeacherModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($teacher);
                // (new LogModel)->writeLog("修改老師資料(老師ID: $id)");
                header("Location: /teacher/profile/");
            } else {
                // $teacher = (new TeacherModel)->where(['id = :id'], [':id' => $id])->fetch();
                // $this->assign('teacher', $teacher);
                $this->render();
            }
        } 
    }

    public function courseList()
    {
        auth::checkAuth(true, 'TEACHER');

        $courseList = (new CourseModel)->where(['teacher = :teacher'], [':teacher' => $_SESSION['id']])->fetchAll();

        $this->assign('courseList', $courseList);
        $this->render();
    }

    public function analysis($id = null) {
        $course = (new CourseModel)->where(['id = :id'], [':id' => $id])->fetch();
        if(isset($_SESSION['isLogin'])) {
            if($_SESSION['loginType'] == 3 || ($_SESSION['loginType'] == 2 && $_SESSION['id'] == $course['teacher'])) {
                $count = (new CourseModel)->getCourseStu($id);
                $this->assign('course', $course);
                $this->assign('count', $count);
                $this->render();
            }
        }
    }

    public function hw($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hw = [
                'score' => $_POST['score'],
                'comment' => $_POST['comment']
            ];
            if (isset($_POST['publish'])) {
                $hw['published'] = true;
            }
            (new AssignmentModel)->where(['id = :id'], [':id' => $_POST['id']])->update($hw);            
            $hw = (new AssignmentModel)->where(['id = :id'], [':id' => $_POST['id']])->fetch();
            header("Location: /teacher/hw/" . $hw['course']);
        } else {
            $course = (new CourseModel)->where(['id = :id'], [':id' => $id])->fetch();
            $hwList = (new AssignmentModel)->where(['course = :course'], [':course' => $id])->fetchAll();
            foreach ($hwList as $k => $hw) {
                // $course = (new CourseModel)->where(['id = :id'], [':id' => $hw['course']])->fetch();
                $student = (new StudentModel)->where(['id = :id'], [':id' => $hw['user']])->fetch();
                $hwList[$k]['student_name'] = $student['name'];
            }
            if(isset($_SESSION['isLogin'])) {
                if($_SESSION['loginType'] == 3 || ($_SESSION['loginType'] == 2 && $_SESSION['id'] == $course['teacher'])) {
                    $this->assign('hwList', $hwList);
                    $this->assign('course', $course['name']);
                    $this->render();
                }
            }
        }
    }
}
