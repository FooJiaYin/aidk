<?php

namespace app\controllers;

use libraries\base\Controller;
use libraries\base\Authorization as auth;

use app\models\StudentModel;
use app\models\LogModel;

class SurveyController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function index()
    {
        $this->render();
    }

    public function instructions()
    {
        $this->render();
    }

    public function personal_info()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['question_step'] = 1;
            $_SESSION['surv_email'] = $_POST['email'];
            $_SESSION['surv_school'] = $_POST['school'];
            $_SESSION['surv_grade'] = $_POST['grade'];
            header("Location: /survey/question/q1/");
            exit();
        } else if ((isset($_SESSION['isLogin']) && is_bool($_SESSION['isLogin']) && $_SESSION['isLogin'])) {
            $_SESSION['question_step'] = 1;
            header("Location: /survey/question/q1/");
            exit();
        } else {
            $this->render();
        }
    }

    public function question($q = 'q1')
    {
        if (isset($_GET['set_q'])) {
            $_SESSION['question_step'] = $_GET['set_q'];
        }
        if (!isset($_SESSION['question_step'])) {
            header("Location: /survey/question/");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //print_r($_POST);
            if (($_SESSION['question_step'] >= 1 && $_SESSION['question_step'] <= 6) ||
                ($_SESSION['question_step'] >= 13 && $_SESSION['question_step'] <= 14)
            ) {
                $_SESSION[$q] = $_POST[$q];
            } else if (($_SESSION['question_step'] >= 7 && $_SESSION['question_step'] <= 12) ||
                $_SESSION['question_step'] == 15
            ) {
                foreach ($_POST as $k => $p) {
                    $_SESSION[$k] = $p;
                }
            }
            if ($_SESSION['question_step'] < 15) {
                $_SESSION['question_step'] += 1;
                $next = 'q' . $_SESSION['question_step'];
                header("Location: /survey/question/$next/");
                exit();
            } else {
                $score = [0, 0, 0, 0, 0, 0];
                $w = [5, 4, 3, 2, 1, 0];
                //Q1
                $q1 = json_decode($_SESSION['q1'], true);
                foreach ($q1 as $k => $q) {
                    if ($q == '1') $score[0] += $w[$k];
                    elseif ($q == '2') $score[2] += $w[$k];
                    elseif ($q == '3') $score[3] += $w[$k];
                    elseif ($q == '4') $score[5] += $w[$k];
                    elseif ($q == '5') $score[4] += $w[$k];
                    elseif ($q == '6') $score[1] += $w[$k];
                }

                //Q2
                $q2 = json_decode($_SESSION['q2'], true);
                foreach ($q2 as $k => $q) {
                    if ($q == '1') $score[0] += $w[$k];
                    elseif ($q == '2') $score[3] += $w[$k];
                    elseif ($q == '3') $score[5] += $w[$k];
                    elseif ($q == '4') $score[1] += $w[$k];
                    elseif ($q == '5') $score[2] += $w[$k];
                    elseif ($q == '6') $score[4] += $w[$k];
                }

                //Q3
                $q3 = json_decode($_SESSION['q3'], true);
                foreach ($q3 as $k => $q) {
                    if ($q == '1') $score[5] += $w[$k];
                    elseif ($q == '2') $score[4] += $w[$k];
                    elseif ($q == '3') $score[3] += $w[$k];
                    elseif ($q == '4') $score[2] += $w[$k];
                    elseif ($q == '5') $score[1] += $w[$k];
                    elseif ($q == '6') $score[0] += $w[$k];
                }

                //Q4
                $q4 = json_decode($_SESSION['q4'], true);
                foreach ($q4 as $k => $q) {
                    if ($q == '1') $score[0] += $w[$k];
                    elseif ($q == '2') $score[1] += $w[$k];
                    elseif ($q == '3') $score[2] += $w[$k];
                    elseif ($q == '4') $score[3] += $w[$k];
                    elseif ($q == '5') $score[4] += $w[$k];
                    elseif ($q == '6') $score[5] += $w[$k];
                }

                //Q5
                $q5 = json_decode($_SESSION['q5'], true);
                foreach ($q5 as $k => $q) {
                    if ($q == '1') $score[0] += $w[$k];
                    elseif ($q == '2') $score[1] += $w[$k];
                    elseif ($q == '3') $score[2] += $w[$k];
                    elseif ($q == '4') $score[3] += $w[$k];
                    elseif ($q == '5') $score[4] += $w[$k];
                    elseif ($q == '6') $score[5] += $w[$k];
                }

                //Q6
                $q6 = json_decode($_SESSION['q6'], true);
                foreach ($q6 as $k => $q) {
                    if ($q == '1') $score[0] += $w[$k];
                    elseif ($q == '2') $score[1] += $w[$k];
                    elseif ($q == '3') $score[2] += $w[$k];
                    elseif ($q == '4') $score[3] += $w[$k];
                    elseif ($q == '5') $score[4] += $w[$k];
                    elseif ($q == '6') $score[5] += $w[$k];
                }

                //Q7
                $score[1] += intval($_SESSION['q7-1']);
                $score[1] += intval($_SESSION['q7-2']);
                $score[4] += intval($_SESSION['q7-3']);
                $score[3] += intval($_SESSION['q7-4']);
                $score[0] += intval($_SESSION['q7-5']);
                $score[2] += intval($_SESSION['q7-6']);

                //Q8
                $score[5] += intval($_SESSION['q8-1']);
                $score[0] += intval($_SESSION['q8-2']);
                $score[3] += intval($_SESSION['q8-3']);
                $score[4] += intval($_SESSION['q8-4']);
                $score[4] += intval($_SESSION['q8-5']);
                $score[2] += intval($_SESSION['q8-6']);

                //Q9
                $score[1] += intval($_SESSION['q9-1']);
                $score[5] += intval($_SESSION['q9-2']);
                $score[2] += intval($_SESSION['q9-3']);
                $score[4] += intval($_SESSION['q9-4']);
                $score[3] += intval($_SESSION['q9-5']);
                $score[0] += intval($_SESSION['q9-6']);

                //Q10
                $score[1] += intval($_SESSION['q10-1']);
                $score[0] += intval($_SESSION['q10-2']);
                $score[0] += intval($_SESSION['q10-3']);
                $score[2] += intval($_SESSION['q10-4']);
                $score[1] += intval($_SESSION['q10-5']);
                $score[3] += intval($_SESSION['q10-6']);

                //Q11
                $score[1] += intval($_SESSION['q11-1']);
                $score[2] += intval($_SESSION['q11-2']);
                $score[3] += intval($_SESSION['q11-3']);
                $score[3] += intval($_SESSION['q11-4']);
                $score[4] += intval($_SESSION['q11-5']);

                //Q12
                $score[0] += intval($_SESSION['q11-1']);
                $score[2] += intval($_SESSION['q11-2']);
                $score[3] += intval($_SESSION['q11-3']);
                $score[1] += intval($_SESSION['q11-4']);
                $score[4] += intval($_SESSION['q11-5']);

                //Q13
                $q13 = json_decode($_SESSION['q13'], true);
                foreach ($q13 as $k => $q) {
                    if ($q == '1') $score[4] += $w[$k];
                    elseif ($q == '2') $score[4] += $w[$k];
                    elseif ($q == '3') $score[4] += $w[$k];
                    elseif ($q == '4') $score[4] += $w[$k];
                    elseif ($q == '5') $score[1] += $w[$k];
                    elseif ($q == '6') $score[1] += $w[$k];
                    elseif ($q == '7') $score[1] += $w[$k];
                    elseif ($q == '8') $score[5] += $w[$k];
                    elseif ($q == '9') $score[5] += $w[$k];
                    elseif ($q == '10') $score[5] += $w[$k];
                    elseif ($q == '11') $score[5] += $w[$k];
                    elseif ($q == '12') $score[2] += $w[$k];
                    elseif ($q == '13') $score[2] += $w[$k];
                    elseif ($q == '14') $score[0] += $w[$k];
                    elseif ($q == '15') $score[0] += $w[$k];
                    elseif ($q == '16') $score[0] += $w[$k];
                    elseif ($q == '17') $score[3] += $w[$k];
                    elseif ($q == '18') $score[3] += $w[$k];
                }

                $score = json_encode($score);
                if ((isset($_SESSION['isLogin']) && is_bool($_SESSION['isLogin']) && $_SESSION['isLogin'])) {
                    $data['score'] = $score;
                    (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($data);
                    header("Location: /student/myScore/");
                } else {
                    $_SESSION['surv_score'] = $score;
                    header("Location: /survey/signup/");
                }
                exit();
            }
        } else {
            $question_step = $_SESSION['question_step'];
            if ($q == 'q' . $question_step)
                $this->render($q);
            else
                header("Location: /survey/question/q$question_step/");
            exit();
        }
    }

    public function signup()
    {
        if (isset($_GET['debug'])) $_SESSION['surv_score'] = "[20, 30, 40, 50, 60, 70]";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userCheck = (new StudentModel)->where(['account = :account'], [':account' => $_POST['email']])->count();
            if ($userCheck) {
                if (isset($_POST['nologin'])) {
                    header("Location: /survey/signup/?alert=1&msg=信箱重複&redirect=/survey/signup/?nologin");
                } else {
                    header("Location: /survey/signup/?alert=1&msg=信箱重複");
                }
                exit();
            }
            $user['account'] = $_POST['email'];
            $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user['name'] = $_POST['name'];
            $user['gender'] = $_POST['gender'];
            $user['school'] = $_POST['school'];
            $user['grade'] = $_POST['grade'];
            $user['birthday'] = $_POST['birthday'];
            $user['phone'] = $_POST['phone'];
            $user['address'] = $_POST['address'];
            $user['google_token'] = $_POST['google_token'];
            $user['fb_token'] = $_POST['fb_token'];
            if (isset($_SESSION['surv_score'])) {
                $user['score'] = $_SESSION['surv_score'];
            } else {
                $user['score'] = "[0, 0, 0, 0, 0, 0]";
            }
            (new StudentModel)->add($user);

            $student = (new StudentModel)->where(['account = :account'], [':account' => $_POST['email']])->fetch();

            $account = $_POST['email'];
            if ($student && auth::doLogin($student, $_POST['password'])) {
                (new LogModel)->writeLog("學生帳號註冊(帳號: $account)");
                header("Location: /student/myScore/");
            } else {
                (new LogModel)->writeLog("學生帳號註冊失敗(帳號: $account, 異常操作)");
                //print_r($user);
                header("Location: /");
            }
            exit();
        } else {
            //print_r($_SESSION);
            $this->render();
        }
    }

    public function snsSignupCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginBy = $_POST['loginBy'];
            $email = $_POST['email'];
            $token = $_POST['token'];

            if ($loginBy == "FB") {
                $student = (new StudentModel)->where(['account = :account'], [':account' => $email])->fetch();
            } else if ($loginBy == "GOOGLE") {
                $student = (new StudentModel)->where(['account = :account'], [':account' => $email])->fetch();
            } else {
                $student = false;
            }

            if ($student) {
                $loginCheck = false;
            } else {
                $loginCheck = true;
            }

            $result = [
                "result" => $loginCheck,
                "msg" => $student,
            ];

            echo json_encode($result);
        } else {
            header("Location: /");
            exit();
        }
    }

    public function survey_login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['surv_score'])) {
                $user['score'] = $_SESSION['surv_score'];
            }

            if ($_POST['loginBy'] == "web")
                $student = (new StudentModel)->where(['account = :account'], [':account' => $_POST['account']])->fetch();
            else if ($_POST['loginBy'] == "FB") {
                $student = (new StudentModel)->where(['account = :account', 'AND', 'fb_token = :fb_token'], [':account' => $_POST['account'], ':fb_token' => $_POST['password']])->fetch();
            } else if ($_POST['loginBy'] == "GOOGLE") {
                $student = (new StudentModel)->where(['account = :account', 'AND', 'google_token = :google_token'], [':account' => $_POST['account'], ':google_token' => $_POST['password']])->fetch();
            } else {
                $student = false;
            }

            if (($_POST['loginBy'] == "FB" || $_POST['loginBy'] == "GOOGLE") && $student) {
                $_SESSION['isLogin'] = true;
                $_SESSION['id'] = $student['id'];
                $_SESSION['account'] = $student['account'];
                $_SESSION['loginType'] = 1;
            }

            $account = $_POST['account'];
            if (($_POST['loginBy'] == "web" && $student && auth::doLogin($student, $_POST['password'])) ||
                (($_POST['loginBy'] == "FB" || $_POST['loginBy'] == "GOOGLE") && $student)
            ) {
                (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->update($user);
                (new LogModel)->writeLog("學生登入(重新測驗)(帳號: $account)");
                header("Location: /student/myScore/");
            } else {
                (new LogModel)->writeLog("學生登入失敗(重新測驗)(帳號: $account)");
                if ($_POST['loginBy'] == "web")
                    header("Location: /survey/signup/?alert=1&msg=帳號或密碼錯誤！");
                else
                    header("Location: /survey/signup/?alert=1&msg=該帳號尚未被綁定！");
            }
            exit();
        } else {
            //print_r($_SESSION);
            $this->render();
        }
    }
}
