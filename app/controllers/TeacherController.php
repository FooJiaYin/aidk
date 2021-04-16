<?php

namespace app\controllers;

use app\models\CourseModel;
use libraries\base\Controller;
use libraries\base\Authorization as auth;

use app\models\TeacherModel;
use app\models\LogModel;

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

    public function courseList()
    {
        auth::checkAuth(true, true);

        $courseList = (new CourseModel)->where(['teacher = :teacher'], [':teacher' => $_SESSION['id']])->fetchAll();

        $this->assign('courseList', $courseList);
        $this->render();
    }
}
