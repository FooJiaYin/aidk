<?php

namespace app\controllers;

use app\models\CourseModel;
use app\models\StudentModel;
use app\models\TeacherModel;
use app\models\LogModel;

use libraries\base\Controller;
use libraries\base\Authorization as auth;
use libraries\base\Common;

class AdminController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function index()
    {
        header("Location: /admin/dashboard/");
        exit();
    }

    // 使用者登入介面
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = $_POST['account'];
            $password = $_POST['password'];

            if ($account == 'admin') {
                $admin = [
                    'password' => '$2y$10$oKLmDppZxBNXpU2gH9tELegc9Fbf01GxENEcrIjtd/3aQenjaTcla'
                ];
            } else {
                $admin = null;
            }

            if ($admin && auth::doLogin($admin, $password, 3)) {
                (new LogModel)->writeLog("管理員登入");
                header("Location: /admin/dashboard/");
            } else {
                (new LogModel)->writeLog("管理員登入失敗");
                header("Location: /admin/login/");
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

    public function dashboard()
    {
        auth::checkAuth(true, 'ADMIN');

        $courseCount = (new CourseModel)->count();
        $studentCount = (new StudentModel)->count();
        $teacherCount = (new TeacherModel)->count();
        $surveyCount = (new StudentModel)->where(['rawAns IS NOT NULL'])->count();

        $this->assign('courseCount', $courseCount);
        $this->assign('studentCount', $studentCount);
        $this->assign('teacherCount', $teacherCount);
        $this->assign('surveyCount', $surveyCount);
        $this->render();
    }

    public function courses()
    {
        auth::checkAuth(true, 'ADMIN');

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $courseList = (new CourseModel)->searchCourse($_GET['search']);
        } else {
            $courseList = (new CourseModel)->fetchAll();
        }

        $this->assign('courseList', $courseList);
        $this->render();
    }

    public function newCourse()
    {
        auth::checkAuth(true, 'ADMIN');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 處理表單資料
            $courseSetting = json_decode($_POST['course'], true);
            // $categoryList = $courseSetting['category'];
            // $categoryStr = "[";
            // $N = count($categoryList);
            // foreach($categoryList as $i => $c) {
            //     $categoryStr .= (string) $c;
            //     if($i < $N-1) $categoryStr .= ", ";
            // }
            // $categoryStr .= "]";
            $course = [
                'name' => $courseSetting['name'],
                'category' => $courseSetting['category'],
                'price' => $courseSetting['price'],
                'description' => $courseSetting['description'],
                'teacher' => $courseSetting['teacher']
            ];

            $courseID = (new CourseModel)->add($course, true);
            unset($course);

            // 建立目錄
            mkdir("course_data/$courseID/videos/", 0777, true);
            mkdir("course_data/$courseID/hw/", 0777, true);
            mkdir("course_data/$courseID/img/", 0777, true);

            // 處理圖片
            foreach ($_FILES['img']['tmp_name'] as $k => $img) {
                $filename = explode('.', $_FILES['img']['name'][$k]);
                $ext = end($filename);
                $filename = $k . "_" . time() . "." . $ext;
                move_uploaded_file($img, "course_data/$courseID/img/$filename");
            }

            // 處理介紹影片
            if (isset($_FILES['intro'])) {
                $filename = explode('.', $_FILES['intro']['name']);
                $ext = end($filename);
                move_uploaded_file($_FILES['intro']['tmp_name'], "course_data/$courseID/intro.$ext");
            }

            // 處理章節影片
            require_once('libraries/vendor/getID3/getid3/getid3.php');
            $getID3 = new \getID3;
            $chapters = $courseSetting['chapter'];
            $chapter_array = [];
            $video_dur = [];

            foreach ($chapters as $chapter) {
                $scrt = [];
                foreach ($chapter['section'] as $sect) {
                    $tmp_video = $_FILES['sect_video']['tmp_name'][$sect['index']];
                    $id3 = $getID3->analyze($tmp_video);
                    $dur = $id3['playtime_string'];
                    $filename = explode('.', $_FILES['sect_video']['name'][$sect['index']]);
                    $ext = end($filename);
                    $filename = $sect['index'] . "_" . time() . "." . $ext;
                    move_uploaded_file($tmp_video, "course_data/$courseID/videos/$filename");
                    array_push($video_dur, $dur);

                    $sect_tmp = [
                        "name" => $sect['name'],
                        "duration" => $dur,
                        "video" => $filename
                    ];

                    array_push($scrt, $sect_tmp);
                }
                $chap_tmp = [
                    "name" => $chapter['name'],
                    "section" => $scrt
                ];

                array_push($chapter_array, $chap_tmp);
            }

            $course = [
                'chapter' => json_encode($chapter_array, JSON_UNESCAPED_UNICODE),
                'duration' => Common::CalculateTime($video_dur)
            ];
            (new CourseModel)->where(['id = :id'], [':id' => $courseID])->update($course);
            $name = $courseSetting['name'];
            (new LogModel)->writeLog("建立課程($name)");
            echo json_encode([
                'result' => 1
            ], JSON_UNESCAPED_UNICODE);
        } else {

            $teachers = (new TeacherModel)->fetchAll();

            $this->assign('teachers', $teachers);
            $this->render();
        }
    }

    public function courseEdit($id = null)
    {
        auth::checkAuth(true, 'ADMIN');

        if ($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // $categoryList = $_POST['category'];
                // $categoryStr = "[";
                // $N = count($categoryList);
                // foreach($categoryList as $i => $c) {
                //     $categoryStr .= (string) $c;
                //     if($i < $N-1) $categoryStr .= ", ";
                // }
                // $categoryStr .= "]";
                $categoryStr = json_encode($_POST['category']);
                $course = [
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'teacher' => $_POST['teacher'],
                    'share' => $_POST['share'],
                    'category' => $categoryStr
                ];
                (new CourseModel)->where(['id = :id'], [':id' => $id])->update($course);
                (new LogModel)->writeLog("修改課程資料(課程ID: $id)");
                header("Location: /admin/courses/");
            } else {
                $course = (new CourseModel)->where(['id = :id'], [':id' => $id])->fetch();
                if(! $course) header("Location: /admin/courses/");
                $teachers = (new TeacherModel)->fetchAll();
                $course['category'] = json_decode($course['category'], true);
                $this->assign('course', $course);
                $this->assign('teachers', $teachers);
                $this->render();
            }
        } else {
            header("Location: /admin/courses/");
        }
    }

    public function delCourse()
    {
        auth::checkAuth(true, 'ADMIN');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['course']) && isset($_POST['name'])) {
                (new CourseModel)->delete($_POST['course']);
                (new LogModel)->writeLog("刪除課程(" . $_POST['name'] . "，ID: " . $_POST['course'] . ")");
                echo '{"status": 1}';
            } else {
                (new LogModel)->writeLog("操作異常(刪除課程)");
                echo '{"status": 0}';
            }
        }
    }

    public function students()
    {
        auth::checkAuth(true, 'ADMIN');

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $stuList = (new StudentModel)->searchStu($_GET['search']);
        } else {
            $stuList = (new StudentModel)->fetchAll();
        }

        $this->assign('stuList', $stuList);
        $this->render();
    }

    public function newStudent($id = null)
    {
        auth::checkAuth(true, 'ADMIN');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account'])) {
            $account = $_POST['account'];
            $studentCount = (new StudentModel)->where(['account = :account'], [':account' => $_POST['account']])->count();
            if ($studentCount == 0) {
                $student = [
                    'account' => $account,
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'name' => $_POST['name'],
                    'gender' => $_POST['gender'],
                    'school' => $_POST['school'],
                    'grade' => $_POST['grade'],
                    'birthday' => $_POST['birthday'],
                    'phone' => $_POST['phone'],
                    'address' => $_POST['address'],
                    'score' => '[0,0,0,0,0,0]'
                ];
                $studentID = (new StudentModel)->add($student, true);
                if ($studentID) {
                    (new LogModel)->writeLog("新增學生帳號(帳號: $account, ID：$studentID)");
                    header("Location: /admin/students/");
                } else {
                    (new LogModel)->writeLog("新增學生帳號失敗(帳號: $account)");
                    header("Location: /admin/students/");
                }
            } else {
                header("Location: /admin/newStudent/?alert=1&msg=帳號重複！");
            }
            exit();
        } else {
            $this->render();
        }
    }

    public function studentEdit($id = null)
    {
        auth::checkAuth(true, 'ADMIN');

        if ($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['coin_add'])) {
                    $add = $_POST['add'];
                    $credit = $_POST['credit'];
                    $credit = (int)$credit + (int)$add;
                    $stu = [
                        'credit' => $credit,
                    ];
                    (new StudentModel)->where(['id = :id'], [':id' => $id])->update($stu);
                    (new LogModel)->writeLog("學習幣手動加值(學生ID: $id, 數量: $add)");
                    header("Location: /admin/studentEdit/$id/");
                } else {
                    $stu = [
                        'name' => $_POST['name'],
                        'gender' => $_POST['gender'],
                        'account' => $_POST['account'],
                        'credit' => $_POST['credit'],
                        'school' => $_POST['school'],
                        'grade' => $_POST['grade'],
                        'birthday' => $_POST['birthday'],
                        'phone' => $_POST['phone'],
                        'address' => $_POST['address'],
                    ];
                    (new StudentModel)->where(['id = :id'], [':id' => $id])->update($stu);
                    (new LogModel)->writeLog("修改學生資料(學生ID: $id)");
                    header("Location: /admin/students/");
                }
            } else {
                $stu = (new StudentModel)->where(['id = :id'], [':id' => $id])->fetch();
                $this->assign('stu', $stu);
                $this->render();
            }
        } else {
            header("Location: /admin/students/");
        }
    }

    public function teachers()
    {
        auth::checkAuth(true, 'ADMIN');

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $teacherList = (new TeacherModel)->searchTeacher($_GET['search']);
        } else {
            $teacherList = (new TeacherModel)->fetchAll();
        }

        foreach ($teacherList as $k => $t) {
            $courses = (new CourseModel)->where(['teacher = :t'], [':t' => $t['id']])->fetchAll();
            $c = [];
            foreach ($courses as $course) {
                array_push($c, $course['name']);
            }
            $teacherList[$k]['courses'] = join("、", $c);
        }

        $this->assign('teacherList', $teacherList);
        $this->render();
    }

    public function newTeacher($id = null)
    {
        auth::checkAuth(true, 'ADMIN');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account'])) {
            $account = $_POST['account'];
            $teacherCount = (new TeacherModel)->where(['account = :account', 'OR', 'email = :email'], [':account' => $_POST['account'], ':email' => $_POST['email']])->count();
            if ($teacherCount == 0) {
                $teacher = [
                    'account' => $account,
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'name' => $_POST['name'],
                    'gender' => $_POST['gender'],
                    'email' => $_POST['email']
                ];
                $teacherID = (new TeacherModel)->add($teacher, true);
                (new LogModel)->writeLog("新增老師帳號(帳號: $account, ID：$teacherID)");
                header("Location: /admin/teachers/");
            } else {
                header("Location: /admin/newTeacher/?alert=1&msg=帳號重複！");
            }
        } else {
            $this->render();
        }
    }

    public function teacherEdit($id = null)
    {
        auth::checkAuth(true, 'ADMIN');

        if ($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $teacher = [
                    'name' => $_POST['name'],
                    'gender' => $_POST['gender'],
                    'email' => $_POST['email']
                ];
                (new TeacherModel)->where(['id = :id'], [':id' => $id])->update($teacher);
                (new LogModel)->writeLog("修改老師資料(老師ID: $id)");
                header("Location: /admin/teachers/");
            } else {
                $teacher = (new TeacherModel)->where(['id = :id'], [':id' => $id])->fetch();
                $this->assign('teacher', $teacher);
                $this->render();
            }
        } else {
            header("Location: /admin/teachers/");
        }
    }

    public function resetUser()
    {
        auth::checkAuth(true, 'ADMIN');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'password' => password_hash('1111', PASSWORD_DEFAULT)
            ];
            if ($_POST['type'] == '1') {
                (new StudentModel)->where(['id = :id'], [':id' => $_POST['user']])->update($user);
                (new LogModel)->writeLog("重置學生密碼(ID: " . $_POST['user'] . ")");
                echo '{"status": 1}';
            } else if ($_POST['type'] == '2') {
                (new TeacherModel)->where(['id = :id'], [':id' => $_POST['user']])->update($user);
                (new LogModel)->writeLog("重置老師密碼(ID: " . $_POST['user'] . ")");
                echo '{"status": 1}';
            } else {
                (new LogModel)->writeLog("操作異常(重置密碼)");
                echo '{"status": 0}';
            }
        }
    }

    public function delUser()
    {
        auth::checkAuth(true, 'ADMIN');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['type'] == '1') {
                (new StudentModel)->delete($_POST['user']);
                (new LogModel)->writeLog("刪除學生帳號(ID: " . $_POST['user'] . ")");
                echo '{"status": 1}';
            } else if ($_POST['type'] == '2') {
                (new TeacherModel)->delete($_POST['user']);
                (new CourseModel)->deleteBy('teacher', $_POST['user']);
                (new LogModel)->writeLog("刪除老師帳號(ID: " . $_POST['user'] . ")");
                echo '{"status": 1}';
            } else {
                (new LogModel)->writeLog("操作異常(刪除帳號)");
                echo '{"status": 0}';
            }
        }
    }

    public function logs()
    {
        auth::checkAuth(true, 'ADMIN');

        $logs = (new LogModel)->order(['id DESC'])->fetchAll();

        $this->assign('logs', $logs);
        $this->render();
    }
}
