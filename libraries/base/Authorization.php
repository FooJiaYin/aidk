<?php

namespace libraries\base;

/**
 * 認證函式庫
 */
class Authorization
{
    public static function doLogin($user, $password, $type = 1)
    {
        if (password_verify($password, $user['password'])) {
            switch ($type) {
                case 1:
                    $_SESSION['isLogin'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['account'] = $user['account'];
                    $_SESSION['loginType'] = 1;
                    break;
                case 2:
                    $_SESSION['isLogin'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['account'] = $user['account'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['loginType'] = 2;
                    break;
                case 3:
                    $_SESSION['isLogin'] = true;
                    $_SESSION['id'] = 0;
                    $_SESSION['loginType'] = 3;
                    break;
                default:
                    return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAuth()
    {
        return (object)[
            "id" => $_SESSION['auth_id'],
            "account" => $_SESSION['auth_account'],
            "accountType" => (int)$_SESSION['auth_accountType'],
            "staffId" => $_SESSION['auth_staffId'],
            "name" => $_SESSION['auth_name'],
            "title" => self::getTitle(),
            "role" => self::getRole(),
            "gender" => self::getGender(),
            "email" => $_SESSION['auth_email'],
            "accountProperty" => $_SESSION['auth_accountProperty'],
            "avatar" => self::getAvatar((int)$_SESSION['auth_avatar']),
            "avatarFile" => self::getAvatar(6),
            "loginCount" => $_SESSION['auth_loginCount'],
            "lastLogin" => $_SESSION['auth_lastLogin'],
            "expiredDate" => $_SESSION['auth_expiredDate'],
        ];
    }

    public static function checkAuth($isRedirect = true, $isTeacher = false)
    {
        if ($isRedirect) {
            if ($isTeacher == 'ADMIN' && (!$_SESSION['isLogin'] || $_SESSION['loginType'] != 3)) {
                header("Location: /admin/login/");
            }
        }
        if (!(isset($_SESSION['isLogin']) && is_bool($_SESSION['isLogin']) && $_SESSION['isLogin'])) {
            if ($isRedirect) {
                if ($isTeacher == 'ADMIN') {
                    header("Location: /admin/login/");
                }
                else if ($isTeacher) {
                    header("Location: /teacher/login/");
                } else {
                    header("Location: /");
                }
                exit();
            } else {
                return false;
            }
        } else {            
            if ($isTeacher == 'ADMIN') {
                if($_SESSION['loginType'] == 3) return true;
                else {
                    if ($isRedirect) header("Location: /admin/login/");
                    else return false;
                }
            } else if ($isTeacher == 'TEACHER') {
                if($_SESSION['loginType'] == 2) return true;
                else {
                    if ($isRedirect) header("Location: /teacher/login/");
                    else return false;
                }
            } else {
                return true;
            }
        }
    }

    public static function checkAuthAtLoginPage()
    {
        if (self::checkAuth(false)) {
            header("Location: /");
            exit();
        }
    }

    public static function checkValidity($date)
    {
        $currentTime = time();
        $expiredTime = strtotime($date);
        if ($expiredTime > $currentTime)
            return true;
        else
            return false;
    }

    private static function getGender()
    {
        if ($_SESSION['auth_gender'] == 1)
            return ['男性', 'male', 'M'];
        else if ($_SESSION['auth_gender'] == 2)
            return ['女性', 'female', 'F'];
        else
            return ['不適用', 'none', 'N'];
    }

    private static function getTitle()
    {
        switch ((int)$_SESSION['auth_accountType']) {
            case 1:
                return '';
            case 2:
                if ($_SESSION['auth_accountProperty']->title == 1) {
                    return '老師';
                } else {
                    if ((int)$_SESSION['auth_gender'] == 1) {
                        return '先生';
                    } else {
                        return '小姐';
                    }
                }
            case 3:
                return '同學';
            default:
                return;
        }
    }

    private static function getRole()
    {
        switch ((int)$_SESSION['auth_accountType']) {
            case 1:
                return '管理員';
            case 2:
                return '教職員';
            case 3:
                return '同學';
            default:
                return;
        }
    }

    private static function getAvatar($avatar)
    {
        switch ($avatar) {
            case 1:
                return 'avatar-female-s1.gif';
            case 2:
                return 'avatar-female-s2.gif';
            case 3:
                return 'avatar-female-s3.gif';
            default:
            case 4:
                return 'avatar-male-s1.gif';
            case 5:
                return 'avatar-male-s2.gif';
            case 6:
                if (is_file('static/img/avatars/' . $_SESSION['auth_avatarFile'])) {
                    return $_SESSION['auth_avatarFile'];
                } else {
                    if ($_SESSION['auth_gender'] == 2) {
                        return 'avatar-female-s1.gif';
                    } else {
                        return 'avatar-male-s1.gif';
                    }
                }
        }
    }
    public static function recaptchaCheck($response)
    {
        // Google reCAPTCHA 網站密鑰
        $data['secret'] = '6LeQjvQZAAAAAI8CdpN0IawznKeirjbkcWbp-dnx';
        $data['response'] = $response;
        $ch = curl_init();
        // 使用CURL驗證
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        curl_close($ch);
        // 解密
        $result = json_decode($result, true);

        // 檢查是否通過驗證
        if (!isset($result['success']) || !$result['success']) {
            // 驗證失敗
            return false;
        } else {
            // 驗證成功
            return true;
        }
    }
}
