<?php


namespace app\controllers;

include('libraries/vendor/tcpdf/tcpdf.php');

use libraries\vendor\PHPMailer\PHPMailer;
use libraries\vendor\PHPMailer\Exception;
use libraries\vendor\tcpdf\TCPDF;
use libraries\base\Controller;
use libraries\base\Authorization as auth;
use libraries\base\Common;

use app\models\StudentModel;
use app\models\CourseModel;
use app\models\SchoolModel;
use app\models\TransactionModel;
use app\models\CourseBoughtModel;
use app\models\AssignmentModel;
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
        $this->assign('newStyle', false);
        $this->assign('user', $this->user);
    }

    public function assignSchools() {        
        $cities = (new SchoolModel)->getDistinct('city');
        $types = (new SchoolModel)->getDistinct('type');
        $schools = (new SchoolModel)->fetchAll();
        $school = (new SchoolModel)->where(['name = :name'], [':name' => $this->user['school']])->fetch();
        if(!$school) {
            $school['city'] = "other";
            $school['type'] = "other";
            $school['name'] = "other";
        }
        $this->assign('cities', $cities);             
        $this->assign('types', $types);             
        $this->assign('schools', $schools);  
        $this->assign('school', $school);  
    }

    public function index()
    {
        header("Location: /student/profile/");
        exit();
    }

    // 使用者登入介面
    // TODO: New style
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
                header("Location: /student/login/?error");
            }
            exit();
        } else {
            $this->render();
        }
    }

    function randomPassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
    
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
    
        return $result;
    }

    // TODO: New style
    public function resetPassword() // $recipient, $content)
    {
        ini_set("SMTP","ssl://smtp.gmail.com");
        ini_set("smtp_port","465");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['account'];
            $userCheck = (new StudentModel)->where(['account = :account'], [':account' => $email])->count();
            if(!$userCheck) {
                echo '<script>alert("此帳號尚未注冊");</script>';
            } else {
                $newPassword = $this->randomPassword(8);
                (new StudentModel)->where(['account = :account'], [':account' => $email])->update([
                    'password' => password_hash($newPassword, PASSWORD_DEFAULT)
                ]);
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'aidk.service@gmail.com';                 // SMTP username
                    $mail->Password = 'service4aidk';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                    $mail->CharSet = "utf-8";
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
    
                    //Recipients
                    $mail->setFrom('aidk.service@gmail.com', 'AIDK');
                    $mail->addAddress($email);     // Add a recipient
    
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "AIDK密碼重置";
                    $mail->Body    = "您已經成功重置密碼，請用以下密碼登入：" . $newPassword;
    
                    $mail->send();
    
                    echo '<script>alert("您已經成功重置密碼，請前往信箱確認。");
                    window.location.href="/survey/signup/";</script>';
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }   
            }
        }      
        $this->render();
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
                $_GET['first'] = true;
                (new LogModel)->writeLog("學生註冊(社群登入)(信箱: $email ,來源: $loginBy)");
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

        $this->assign('newStyle', true);
        $this->render();
    }

    public function profileEdit()
    {
        if(auth::checkAuth()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
                if(isset($_POST['password_old']) && $_POST['password_old'] != '') {
                    $student = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
                    if (password_verify($_POST['password_old'], $student['password'])) {                        
                        (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update([
                            'password' => password_hash($_POST['password_new'], PASSWORD_DEFAULT)
                        ]);
                        echo '<script>alert("成功修改密碼");
                        window.location.href="/student/profile/";</script>';
                    } else {
                        echo '<script>alert("舊密碼輸入錯誤");
                        window.location.href="/student/profileEdit/?editPassword";</script>';
                    }
                }      
                // echo '<script>alert("成功修改密碼");</script>';
                else {
                    $stu = [
                        'name' => $_POST['name'],
                        'gender' => $_POST['gender'],
                        'account' => $_POST['account'],
                        // 'credit' => $_POST['credit'],
                        'school' => $_POST['school'],
                        'grade' => $_POST['grade'],
                        'birthday' => $_POST['birthday'],
                        'phone' => $_POST['phone'],
                        'address' => $_POST['address'],
                    ];
                    (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($stu);
                    (new LogModel)->writeLog("修改學生資料(學生ID)");
                    header("Location: /student/profile/");
                }
            } else {
                $this->assignSchools();  
                $this->assign('newStyle', true);
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

        if (!$result['score'] || $result['score'] == "[0, 0, 0, 0, 0, 0]") {
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
                $courses = array_merge($courses, (new CourseModel)->getCategoryCourses($category, 'id ASC'));
            }
            foreach ($courses as $k => $c) {
                $categoryList = json_decode($c['category'], true);
                $courses[$k]['category'] = $categoryList;
            }

            $this->assign('recCategories', $recCategories);
            $this->assign('interestType', $interestType);
            // $this->assign('randomCourse', $randomCourse);
            $this->assign('courses', $courses);
            $this->assign('newStyle', true);
            $this->render();
        }
    }

    public function record()
    {
        auth::checkAuth();

        $transactions = (new TransactionModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();

        $bougthCourses = (new CourseBoughtModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();
        foreach ($bougthCourses as $k => $c) {
            $course = (new CourseModel)->where(['id = :id'], [':id' => $c['course']])->fetch();
            $bougthCourses[$k]['name'] = $course['name'];
        }
        $this->assign('transactions', $transactions);
        $this->assign('bougthCourses', $bougthCourses);
        $this->assign('newStyle', true);
        $this->render();
    }
        
    public function myCourses()
    {
        auth::checkAuth();
        
        // $bougthCourses = (new CourseBoughtModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();
        // $courses = [];
        // foreach ($bougthCourses as $k => $c) {
        //     $course = (new CourseModel)->where(['id = :id'], [':id' => $c['course']])->fetch();
        //     $courses[] = $course;
        //     // array_push($courses, $course);
        // }
        $courses = (new CourseModel)->getStuCourses();
        foreach ($courses as $k => $c) {
            $categoryList = json_decode($c['category'], true);
            $courses[$k]['category'] = $categoryList;
        }
        $this->assign('courses', $courses);
        $this->assign('newStyle', true);
        $this->render();
    }

    // TODO: New style
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

    public function portfolio()
    {
        if(isset($_GET['intro'])) {
            $this->assign('newStyle', true);
            $this->render();
        }
        else {
            auth::checkAuth();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['download']) && isset($_SESSION['isLogin'])) {
                    $this->downloadPortfolio($_POST);
                }
                else if ($_POST['autobiography']) {
                    (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update([
                        'autobiography' => $_POST['autobiography']
                    ]);
                }
                else if ($_POST['thoughts']) {
                    (new CourseBoughtModel)->where(['id = :id'], [':id' => $_POST['courseId']])->update([
                        'thoughts' => $_POST['thoughts']
                    ]);
                }
            }
            else {
                $bougthCourses = (new CourseBoughtModel)->where(['user = :user'], [':user' => $_SESSION['id']])->fetchAll();
                foreach ($bougthCourses as $k => $courseBought) {
                    $course = (new CourseModel)->where(['id = :id'], [':id' => $courseBought['course']])->fetch();
                    $bougthCourses[$k]['name'] = $course['name'];
                }
                $this->assign('bougthCourses', $bougthCourses);
                $this->assign('newStyle', true);
                $this->render();
            }
        }
    }

    private function downloadPortfolio($formData) {
        $student = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
        // $course = (new CourseModel)->where(['id = :id'], [':id' => $courseBought['course']])->fetch();
        // $pdf = new GenPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // $pdf->output('portfolio.pdf', 'I');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AIDK');
        $pdf->SetTitle('學習歷程');
        $pdf->SetSubject('學習歷程');
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, 30, '學習歷程AI導航者', 'www.aidk.com.tw', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array('DroidSansFallback', '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('DroidSansFallback', '', 12, '', true);

        if (isset($_POST['profile-select']) && $_POST['profile-select'] == "free") {
            $pdf->AddPage();
            
            // Set some content to print
            $html = '<h1 style="text-align: center">基本資料</h1>
            <table border="1" width="100%" cellpadding="4">
                <tr><td width="10%">姓名</td><td colspan="3" width="90%">' . $student['name'] . '</td></tr>
                <tr><td>學校</td><td width="40%">' . $student['school'] . '</td><td width="10%">年級</td><td width="40%">' . $student['grade'] . '</td></tr>
                <tr><td>生日</td><td width="40%">' . $student['birthday'] . '</td><td width="10%">性別</td><td width="40%">' . (($student['gender'] == 'F')? '女' : '男') . '</td></tr>
                <tr><td>Email</td><td width="40%">' . $student['account'] . '</td><td width="10%">電話</td><td width="40%">' . $student['phone'] . '</td></tr>
                <tr><td width="10%">住址</td><td colspan="3" width="90%">' . $student['address'] . '</td></tr>
            </table>
            <br><br><br>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
        }
        if (isset($_POST['autobiography-select']) && $_POST['autobiography-select'] == "free") {
            if(!isset($_POST['profile-select'])) $pdf->AddPage();
            
            // Set some content to print
            $html = '<h1 style="text-align: center">自傳</h1>' . 
            '<p>' . $student['autobiography'] . '</p>';
            // '<p>日期：' . date("Y/m/d") . '</p>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if (isset($_POST['score-select']) && $_POST['score-select'] == "free") {
            $pdf->AddPage();                            
            $scoreImg = $formData['scoreImg_base64'];  
            $scoreImg = str_replace('data:image/jpeg;base64,', '', $scoreImg);  
            $scoreImg = str_replace(' ', '+', $scoreImg);  
            $data = base64_decode($scoreImg);
            $pdf->Image('@'.$data, 50, 100, 120, 120);             
            $html = '<h1 style="text-align: center">興趣測驗分析報告</h1>
            <p>美國約翰‧霍普金斯大學心理學教授John Holland，於1959年開始陸續提出職業興趣理論及其延伸，將人格與職業興趣結合，分為六種類型。 受測者主要利用問卷調查來瞭解自己的性向，並根據分數而計算出個人對六種特質的偏好。</p>
            <p>本測驗係以上述的生涯理論為基礎所發展而成的。他認為職業選擇是個人基於過去經驗的累積，加上人格特質的影響而做的抉擇，故同一職業會吸引有相同經驗與相似人格特質的人，職業上的適應與滿足也決定於人格和工作環境的適配度。以下為Holland所提的一些理論假設：</p>
            <ol>
                <li>人的個性與工作環境皆可區分為六種類型：企業型（E）、研究型（I）、事務型（C）、社會型（S）、實用型（R）、藝術型（A）。</li>
                <li>找到與自己類型一致的環境，會生活得較為滿意，學業、工作起來會更容易感受到勝任愉快</li>
            </ol>
            <img src="data:image/jpeg;base64,' . $scoreImg . '"  width="50" height="50">';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        foreach ($_POST['course-select'] as $k => $selectedCourse) {
            $selectedCourse = intval($selectedCourse);
            // print($selectedCourse . ' ');
            $pdf->AddPage();
            $courseBought = (new CourseBoughtModel)->where(['id = :id'], [':id' => $selectedCourse])->fetch();
            $course = (new CourseModel)->where(['id = :id'], [':id' => $courseBought['course']])->fetch();

            $html = '<h1 style="text-align: center">課程證書</h1>
                <p style="text-align: center">學生 ' . $student['name'] . ' 已完成課程 ' . $course['name'] . ' ，特此頒發證書</p>
                <p>日期：' . date("Y/m/d") . '</p>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $pdf->AddPage();
            $html = '<h1 style="text-align: center">' . $course['name'] . '</h1>
                <h2>學習心得：</h2>
                <p>' . $courseBought['thoughts'] . '</p>
                <h2>教師評語：</h2>
                <p>' . $courseBought['feedback'] . '</p>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        $pdf->Output('portfolio.pdf', 'I');
    }

    // TODO: New style
    public function hw($id = null) {
        if(isset($_SESSION['isLogin'])) {
            $courseBought = (new CourseBoughtModel)->where(['id = :id'], [':id' => $id])->fetch();
            if($_SESSION['id'] == $courseBought['user']) {
                $course = (new CourseModel)->where(['id = :id'], [':id' => $courseBought['course']])->fetch();
                $hwList = (new AssignmentModel)->where(['course_bought = :course_bought'], [':course_bought' => $id])->fetchAll();
                $student = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
                foreach ($hwList as $k => $hw) {
                    $hwList[$k]['student_name'] = $student['name'];
                }
                $this->assign('hwList', $hwList);
                $this->assign('course', $course['name']);
                $this->render();
            }
        }
    }

    function cert($id) {
        if(isset($_SESSION['isLogin'])) {
            $student = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch();
            $courseBought = (new CourseBoughtModel)->where(['id = :id'], [':id' => $id])->fetch();
            if($_SESSION['id'] == $courseBought['user']) {
                $course = (new CourseModel)->where(['id = :id'], [':id' => $courseBought['course']])->fetch();

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('AIDK');
                $pdf->SetTitle('課程證書');
                $pdf->SetSubject('課程證書');
                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, 30, '學習歷程AI導航者', 'www.aidk.com.tw', array(0,64,255), array(0,64,128));
                $pdf->setFooterData(array(0,64,0), array(0,64,128));

                // set header and footer fonts
                $pdf->setHeaderFont(Array('DroidSansFallback', '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                // Set font
                $pdf->SetFont('DroidSansFallback', '', 12, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // Set some content to print
                $html = '<h1 style="text-align: center">課程證書</h1>' . 
                '<p style="text-align: center">學生 ' . $student['name'] . ' 已完成課程 ' . $course['name'] . ' ，特此頒發證書</p>' .
                '<p>日期：' . date("Y/m/d") . '</p>';

                // Print text using writeHTMLCell()
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

                // $pdf->AddPage();
                $pdf->Output('certificate.pdf', 'I');
            }
        }
    }

    public function privacyPolicy() 
    {
        $this->render();
    }
}
