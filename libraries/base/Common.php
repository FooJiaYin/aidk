<?php

namespace libraries\base;

use libraries\vendor\PHPMailer\PHPMailer;
use libraries\vendor\PHPMailer\Exception;

class Common
{
    public function loadApps()
    {
    }

    public static function getGender($gender)
    {
        if ($gender == 1)
            return ['男性', 'male', 'M'];
        else if ($gender == 2)
            return ['女性', 'female', 'F'];
        else
            return ['不適用', 'none', 'N'];
    }

    public static function showMsg()
    {
        if (isset($_SESSION['msgShow']) && $_SESSION['msgShow']) {
            $msgType = $_SESSION['msgType'];
            $msgTitle = $_SESSION['msgTitle'];
            $msgText = $_SESSION['msgText'];
            $swal = "Swal.fire('$msgTitle', '$msgText', '$msgType');";

            unset($_SESSION['msgShow']);
            unset($_SESSION['msgType']);
            unset($_SESSION['msgText']);

            return ($swal);
        }
    }

    public static function sendMail($recipient, $content)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-relay.sendinblue.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'jerry.chiang@walnutek.com';                 // SMTP username
            $mail->Password = 'fFSG4CHaBT1mWKv3';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->CharSet = "utf-8";

            //Recipients
            $mail->setFrom('admin@walnutek.com', 'SmartAdmin');
            $mail->addAddress($recipient[0], $recipient[1]);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $content[0];
            $mail->Body    = $content[1];

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public static function getAvatar($avatar, $avatarFile, $gender)
    {
        switch ((int)$avatar) {
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
                if (is_file('static/img/avatars/' . $avatarFile))
                    return $avatarFile;
                else {
                    if ($gender == 1 || $gender == 'M')
                        return 'avatar-male-s1.gif';
                    else
                        return 'avatar-female-s1.gif';
                }
        }
    }

    public static function cmp($a, $b)
    {
        if ($a['prop'] == $b['prop']) {
            return 0;
        }
        return ($a['prop'] > $b['prop']) ? -1 : 1;
    }

    public static function CalculateTime($times) {
        $i = 0;
        foreach ($times as $time) {
            sscanf($time, '%d:%d', $min, $sec);
            $i += $min * 60 + $sec;
        }

        if($h = floor($i / 60)) {
            $i %= 60;
        }

        return sprintf('%02d:%02d', $h, $i);
    }
}
