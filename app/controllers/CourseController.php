<?php

namespace app\controllers;

use libraries\base\Controller;
use libraries\base\Authorization as auth;
use libraries\base\GenPDF;

use app\models\StudentModel;
use app\models\CourseModel;
use app\models\CourseBoughtModel;
use app\models\CommentModel;
use app\models\LogModel;


class CourseController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    function assignCourses($courses) {
        foreach ($courses as $k => $c) {
            $categoryList = json_decode($c['category'], true);
            $courses[$k]['category'] = $categoryList;
        }
        $this->assign('courses', $courses);  
    }

    public function index($search = null)
    {
        if ($search == 'search' && isset($_GET['keyword']) && $_GET['keyword'] != '') {
            $courses = (new CourseModel)->searchCourse($_GET['keyword']);
        } else {
            $courses = (new CourseModel)->fetchAll();
        }
        $this->assignCourses($courses);       
        $this->assign('category', null);
        $this->render();
    }

    public function view($id)
    {
        $course = (new CourseModel)->where(['id = :id'], [':id' => $id])->fetch();

        $duration = explode(":", $course['duration']);
        $course['duration'] = sprintf("%d分%d秒", $duration[0], $duration[1]);
        $course['chapter'] = json_decode($course['chapter'], true);

        $path = "course_data/$id/img/";
        $imgs = array_diff(scandir($path), array('.', '..'));
        
        if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 1 && isset($_SESSION['id'])) {
            $isBought = (new CourseBoughtModel)->where(['course = :course', 'AND', 'user = :user'], [':course' => $id, ':user' => $_SESSION['id']])->count();
        } else if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 2 && isset($_SESSION['id'])) {
            $isBought = (new CourseModel)->where(['id = :id', 'AND', 'teacher = :teacher'], [':id' => $id, ':teacher' => $_SESSION['id']])->count();
        } else if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 3 && isset($_SESSION['id'])) {
            $isBought = true;
        } else {
            $isBought = false;
        }

        // $this->assignCourses($course);  
        $this->assign('course', $course); 
        $this->assign('imgs', $imgs);
        $this->assign('isBought', $isBought);
        $this->render();
    }

    public function play($id)
    {
        auth::checkAuth();

        if ($_SESSION['loginType'] == 1) {
            $isBought = (new CourseBoughtModel)->where(['course = :course', 'AND', 'user = :user'], [':course' => $id, ':user' => $_SESSION['id']])->fetch();
        } else if ($_SESSION['loginType'] == 2) {
            $isBought = (new CourseModel)->where(['id = :id', 'AND', 'teacher = :teacher'], [':id' => $id, ':teacher' => $_SESSION['id']])->count();
        } else if ($_SESSION['loginType'] == 3) {
            $isBought = true;
        } else {
            $isBought = false;
        }
        if (!$isBought) {
            header("Location: /");
            exit();
        }

        $course = (new CourseModel)->where(['id = :id'], [':id' => $id])->fetch();
        $course['chapter'] = json_decode($course['chapter'], true);

        if (isset($_GET['chapter']) && isset($_GET['section'])) {
            $chapter = $_GET['chapter'];
            $section = $_GET['section'];
            if (!is_file("course_data/$id/videos/" . $course['chapter'][$chapter]['section'][$section]['video'])) {
                $chapter = 0;
                $section = 0;
            }
        } else {
            $chapter = 0;
            $section = 0;
        }

        $video = $course['chapter'][$chapter]['section'][$section]['video'];

        $comments = (new CommentModel)->where(['course = :course'], [':course' => $id])->fetchAll();

        $this->assignCourses($courses);  
        $this->assign('chapter', $chapter);
        $this->assign('section', $section);
        $this->assign('video', $video);
        $this->assign('isBought', $isBought);
        $this->assign('comments', $comments);
        $this->render();
    }

    public function category($category = 0)
    {
        $courses = (new CourseModel)->getCategoryCourses($category);
        $this->assignCourses($courses);
        $this->assign('category', $category);        
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

    public function buy($courseID = null)
    {
        auth::checkAuth();

        if ($courseID) {
            $course = (new CourseModel)->where(['id = :id'], [':id' => $courseID])->fetch();
            $price = $course['price'];
            $stuCount = $course['stuCount'];
            unset($course);

            $user = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
            $credit = $user['credit'];
            unset($user);

            if ($credit >= $price) {
                $user['credit'] = $credit - $price;
                (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($user);

                $course = [
                    'stuCount' => $stuCount + 1
                ];
                (new CourseModel)->where(['id = :id'], [':id' => $courseID])->update($course);

                $bought = [
                    'user' => $_SESSION['id'],
                    'course' => $courseID,
                    'price' => $price,
                ];
                $result = (new CourseBoughtModel)->add($bought);
                if ($result) {
                    $msg = "購買成功！";
                    (new LogModel)->writeLog("課程購買(課程ID: $courseID)");
                } else {
                    (new LogModel)->writeLog("課程購買失敗(課程ID: $courseID, 資料庫寫入異常)");
                    $msg = "購買失敗，請稍後再試一次，若扣款有疑慮請洽詢客服人員！";
                }
                header("Location: /course/view/$courseID/?alert=1&msg=$msg");
            } else {
                (new LogModel)->writeLog("課程購買失敗(課程ID: $courseID, 學習幣不足)");
                header("Location: /course/view/$courseID/?alert=1&msg=學習幣不足！");
            }
        } else {
            header("Location: /");
        }
        exit();
    }

    public function comment($courseID = null)
    {
        auth::checkAuth();

        if ($courseID && $_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['loginType'] != 3) {
            $comment['user'] = $_SESSION['id'];
            $comment['course'] = $courseID;
            $comment['content'] = $_POST['content'];
            if ($_SESSION['loginType'] > 1)
                $comment['isTeacher'] = true;
            (new CommentModel)->add($comment);
            (new LogModel)->writeLog("課程留言(課程ID: $courseID)");
            if (isset($_GET['chapter']) && isset($_GET['chapter'])) {
                $chapter = $_GET['chapter'];
                $section = $_GET['section'];
                header("Location: /course/play/$courseID/?chapter=$chapter&section=$section");
            } else {
                header("Location: /course/play/$courseID/");
            }
        } else {
            (new LogModel)->writeLog("異常留言(課程ID: $courseID)");
            header("Location: /");
        }
        exit();
    }

    public function hw_upload($courseID = null)
    {
        auth::checkAuth();

        if ($courseID) {
            $isBought = (new CourseBoughtModel)->where(['course = :course', 'AND', 'user = :user'], [':course' => $courseID, ':user' => $_SESSION['id']])->fetch();
            if ($isBought && !$isBought['hw_uploaded']) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['hw'])) {
                    $filename = explode('.', $_FILES['hw']['name']);
                    $file_ext = end($filename);
                    $filename = $courseID . "_" . $_SESSION['id'] . "_" . time() . "." . $file_ext;
                    if (move_uploaded_file($_FILES['hw']['tmp_name'], "course_data/$courseID/hw/$filename")) {
                        $data['hw_uploaded'] = true;
                        $data['hw_file'] = $filename;
                        (new CourseBoughtModel)->where(['course = :course', 'AND', 'user = :user'], [':course' => $courseID, ':user' => $_SESSION['id']])->update($data);
                        (new LogModel)->writeLog("作業上傳(課程ID: $courseID)");
                        echo "1";
                    } else {
                        (new LogModel)->writeLog("作業上傳(課程ID: $courseID, 檔案寫入失敗)");
                        echo "0";
                    }
                } else {
                    $this->assign('courseID', $courseID);
                    $this->render();
                }
            } else {
                (new LogModel)->writeLog("作業上傳(課程ID: $courseID, 未購買課程嘗試上傳作業)");
                header("Location: /");
            }
        } else {
            (new LogModel)->writeLog("作業上傳(課程ID: $courseID, 異常操作)");
            header("Location: /");
        }
        exit();
    }

    public function download_cert($courseID = null)
    {
        auth::checkAuth();

        if ($courseID) {
            $isBought = (new CourseBoughtModel)->where(['course = :course', 'AND', 'user = :user', 'AND', 'hw_uploaded = true'], [':course' => $courseID, ':user' => $_SESSION['id']])->fetch();

            $user = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
            $user = $user['name'];
            $course = (new CourseModel)->where(['id = :id'], [':id' => $courseID])->fetch();
            $course = $course['name'];

            if ($isBought) {
                $pdf = new GenPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
                $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

                $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                $pdf->SetMargins(20, 1, 20);

                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                    require_once(dirname(__FILE__) . '/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                $pdf->setFontSubsetting(true);

                $pdf->SetFont('DroidSansFallback', '', 10);

                $pdf->AddPage('P', 'A4');

                $html = "<h3>學生 $user 通過 $course 課程特發此證書。</h3>";

                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

                $pdf->Output('myCert.pdf', 'I');
                (new LogModel)->writeLog("課程證書下載(課程ID: $courseID)");
                exit();
            }
        }

        (new LogModel)->writeLog("課程證書下載(課程ID: $courseID, 異常操作)");
        header("Location: /");
        exit();
    }

    public function twstudy($courseID)
    {               
        $url = "http://pc.twstudy.com/aidk/act/login_pb.html";
        $ch = curl_init();
        $cookie = "";
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR,  "cookie.txt");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, "USER_ID=0901334131&PASSWD=334131");         
        curl_exec($ch);
        $url = "http://pc.twstudy.com/aidk/course.html?CP=";
        $url .= strval($courseID);
        curl_setopt($ch, CURLOPT_URL, $url);
        $html = curl_exec($ch);
        $this->assign('cookie', $cookie);
        $this->assign('html', $html);
        $this->assign('url', $url);
        $this->render();
    }
}
