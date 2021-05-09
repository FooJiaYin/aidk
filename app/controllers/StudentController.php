<?php

namespace app\controllers;

use libraries\base\Controller;
use libraries\base\Authorization as auth;

use app\models\StudentModel;
use app\models\CourseModel;
use app\models\TransactionModel;
use app\models\CourseBoughtModel;
use app\models\LogModel;

class StudentController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        if ((isset($_SESSION['isLogin']) && is_bool($_SESSION['isLogin']) && $_SESSION['isLogin'])) {
            $this->user = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
        } else {
            $this->user = null;
        }

        $this->assign('user', $this->user);
    }

    public function index()
    {
        header("Location: /student/profile/");
        exit();
    }

    // 使用者登入介面
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = $_POST['account'];
            $password = $_POST['password'];

            $student = (new StudentModel)->where(['account = :account'], [':account' => $account])->fetch();

            if ($student && auth::doLogin($student, $password)) {
                (new LogModel)->writeLog("學生登入(帳號: $account)");
                header("Location: /");
            } else {
                (new LogModel)->writeLog("學生登入失敗(帳號: $account, 帳密錯誤)");
                header("Location: /student/login/");
            }
            exit();
        } else {
            $this->render();
        }
    }

    // 社群登入介面
    public function snsLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginBy = $_POST['loginBy'];
            $email = $_POST['email'];
            $token = $_POST['token'];

            if ($loginBy == "FB") {
                $student = (new StudentModel)->where(['account = :account', 'AND', 'fb_token = :fb_token'], [':account' => $email, ':fb_token' => $token])->fetch();
            }else if ($loginBy == "GOOGLE") {
                $student = (new StudentModel)->where(['account = :account', 'AND', 'google_token = :google_token'], [':account' => $email, ':google_token' => $token])->fetch();
            } else {
                $student = false;
            }

            if ($student) {
                $_SESSION['isLogin'] = true;
                $_SESSION['id'] = $student['id'];
                $_SESSION['account'] = $student['account'];
                $_SESSION['loginType'] = 1;
                $loginCheck = true;
                (new LogModel)->writeLog("學生登入(社群登入)(信箱: $email ,來源: $loginBy)");
            } else {
                $loginCheck = false;
                (new LogModel)->writeLog("學生登入失敗(社群登入)(信箱: $email ,來源: $loginBy)");
            }

            $result = [
                "result" => $loginCheck,
                "msg" => $student,
            ];

            echo json_encode($result);
        } else {
            session_destroy();
            header("Location: /");
            exit();
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit();
    }

    public function profile()
    {
        auth::checkAuth();

        $this->render();
    }

    public function profileEdit()
    {
        if(auth::checkAuth()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {                
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
                (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($stu);
                (new LogModel)->writeLog("修改學生資料(學生ID: $id)");
                header("Location: /student/profile/");
            } else {
                $this->render();
            }
        } else {
            header("Location: /student/login/");
        }
    }

    public function myScore()
    {
        auth::checkAuth();        
        $result = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch('score , recCategories');

        if ($result['score'] == "[0, 0, 0, 0, 0, 0]") {
            header("Location: /survey/instructions");
        }
            
        else {

            $interestType = [
                [
                    "name" => "Enterprising 企業型",
                    "desc" => "影響者 Persuader<br />
                    自信、果敢、有影響力且充滿精力·喜歡經營商業活動與做決策。影響者善於運用自己的資源與技能影響別人·讓別人贊同自己所提出的想法或執行方式·也勇於競爭與冒險。在生涯選擇上,影響者更會追求聲望與地位,也非常適合當一名企業家或鼓動他人一同合作並促成計劃。<br />
                    優勢:能找出商業或獲利機會;適合執行與管理工作;具有發展銷售與說服技巧的潛力。",
                    "prop" => 0
                ],
                [
                    "name" => "Investigative 研究型",
                    "desc" => "思考者 Thinker<br />
                    好奇心強、喜歡分析、追求真理,喜歡研究與解決複雜問題。思考者喜歡構想、做研究、探究真理與提出各種假設,平時喜歡讀科技或研究類雜誌,如果好好栽培,是在資料分析與提出理論想法上不可多得的人才。在生涯選擇上更喜歡能讓其不斷思考與研究的工作。<br />
                    優勢:理解、解決科學或數學問題;研究分析;分析與解釋資料、構想與理論;抽象思考。",
                    "prop" => 0
                ],
                [
                    "name" => "Conventional 事務型",
                    "desc" => "組織者Organizer<br />
                    喜歡有系統、嚴謹而有效率的工作方式,並按照精確與清楚的流程行事,無法接受松散無秩序的環境,組織者非常追求事情的所有細節皆能精確且一絲不苟。在生涯選擇上,組織者偏好有序且明確規則的環境、文書或電腦相關處理等一切可順利運轉與掌控的工作。<br />
                    優勢:金融數字運算;資訊處理;組織、規劃與統整能力;文書、行政上精確無誤的處理技巧。",
                    "prop" => 0
                ],
                [
                    "name" => "Social 社交型",
                    "desc" => "助人者 Helper<br />
                    友善、外向且極具包容力,喜歡與人互動與幫助他人助人者關懷社會、生態、周遭人群等外在世界,善於與其他人打成一片,也樂於教導、協助、照顧別人、與解决他人遇到的困難,對如何解決人際衝突或紛爭也特別有一手,在生涯選擇上非常適合與人互動、協助他人有關的工作。<br />
                    優勢:規劃與協調人際活動;善於發現與解決他人問題;優秀的人際與情緒管理能力。",
                    "prop" => 0
                ],
                [
                    "name" => "Realistic 實作型",
                    "desc" => "實作者 Doer<br />
                    注重實際行動、獨自完成任務、喜歡機械或可操作的工具,偏向保守且具體的事物。實作者通常對使用工具、操作機械與飼育動物非常有天賦,喜歡戶外、肢體活動與各種冒險活動。面對問題時,與其討論或空想更喜歡直接嘗試,在生涯上更喜歡接觸能產生具體結果的工作。<br />
                    優勢:製造、建築與修理;機械與設備操作;解決具體性高的問題。",
                    "prop" => 0
                ],
                [
                    "name" => "Artistic 藝術型",
                    "desc" => "創造者 Creator<br />
                    創造者有非常多創意與想像力,總是有非常多新穎的想法想展現。非常喜歡像藝術、戲劇、文學、舞蹈、音樂能發揮創意或展現美感的活動。創造者具有非常強大的直覺與創意靈感,對美學的追求更勝於科學,且喜歡待在充滿變化與挑戰的環境,讓自己的獨特性能充分發揮。<br />
                    優勢:能運用想像力與創造力產生靈感;做事彈性而靈活;善於設計與創造;具有文藝天賦。",
                    "prop" => 0
                ],
            ];
            
            $score = json_decode($result['score'], true);
            $recCategories = json_decode($result['recCategories'], true);
            $total = array_sum($score);
            foreach ($score as $k => $s) {
                $interestType[$k]["prop"] = $s * 100 / 40;
            }

            usort($interestType, array("libraries\base\Common", "cmp"));

            // $randomCourse = (new CourseModel)->getRandomCourse();
            $courses = [];
            foreach ($recCategories as $category) {
                $courses = array_merge($courses, (new CourseModel)->getCategoryCourses($category));
            }
            foreach ($courses as $k => $c) {
                $categoryList = json_decode($c['category'], true);
                $courses[$k]['category'] = $categoryList;
            }

            $this->assign('recCategories', $recCategories);
            $this->assign('interestType', $interestType);
            // $this->assign('randomCourse', $randomCourse);
            $this->assign('courses', $courses);

            $this->render();
        }
    }

    public function record()
    {
        auth::checkAuth();

        $transactions = (new TransactionModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();

        $bougthCourses = (new CourseBoughtModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();

        $this->assign('transactions', $transactions);
        $this->assign('bougthCourses', $bougthCourses);
        $this->render();
    }

    public function myCourses()
    {
        auth::checkAuth();

        $courses = (new CourseModel)->getStuCourses();
        foreach ($courses as $k => $c) {
            $categoryList = json_decode($c['category'], true);
            $courses[$k]['category'] = $categoryList;
        }
        $this->assign('courses', $courses);
        $this->render();
    }

    public function buy_credit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ctype_digit($_POST['amount'])) {
            auth::checkAuth();
            $this->render();
        } else {
            header("Location: /student/record/?status=0");
        }
        exit();
    }

    public function buy_credit_result($amount = null)
    {
        auth::checkAuth();
        if (isset($amount) && isset($_GET['result']) && isset($_GET['AvCode']) && isset($_GET['e_orderno'])) {
            $e_orderno = $_GET['e_orderno'];
            $av_code = $_GET['AvCode'];
            $ret_msg = $_GET['ret_msg'];
            if ($_GET['result'] == '1') {
                $data['user'] = $_SESSION['id'];
                $data['order_no'] = $_GET['e_orderno'];
                $data['av_code'] = $_GET['AvCode'];
                $data['str_check'] = $_GET['str_check'];
                $data['amount'] = $amount;
                $result = (new TransactionModel)->add($data);

                $newCredit['credit'] = $this->user['credit'] + intval($amount);
                $resultCredit = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($newCredit);

                if ($result && $resultCredit) {
                    (new LogModel)->writeLog("購買學習幣(交易單號：$e_orderno, 金額：$amount, 授權碼：$av_code)");
                    header("Location: /student/record/?status=1");
                } else {
                    (new LogModel)->writeLog("購買學習幣(交易單號：$e_orderno, 金額：$amount, 授權碼：$av_code)，資料庫寫入異常");
                    header("Location: /student/record/?status=0");
                }
            } else {
                (new LogModel)->writeLog("學習幣交易失敗(交易單號：$e_orderno, 金額：$amount, 錯誤訊息：$ret_msg)");
                header("Location: /student/record/?status=0");
            }
        } else {
            (new LogModel)->writeLog("異常操作(購買學習幣)");
            header("Location: /");
        }
        exit();
    }
}
