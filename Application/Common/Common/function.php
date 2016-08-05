<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-03
 * Time: 21:38
 */
/**
 * 获取错误信息
 * @param \Think\Model $model model类
 * @return string 错误信息html
 */
function getError(\Think\Model $model)
{
    $errors = $model->getError();
//>>如果不是数组，转换成数组，便于html拼接
    if (!is_array($errors)) {
        $errors = [$errors,];
    }
    $html = "<ol>";
    foreach ($errors as $error) {
        $html .= '<li>' . $error . '</li>';
    }
    $html .= '</ol>';
    return $html;
}

/**
 * 加盐加密
 * @param $salt     盐
 * @param $password 密码
 * @return string   加盐加密后的密码
 */
function saltEncrypt($salt, $password)
{
    return md5(md5($password) . $salt);
}

/**
 * 发送邮件
 * @param $address     发送到的地址
 * @param $title       标题
 * @param $content     内容
 * @param string $host 发送地址
 * @param string $name 发件人
 * @return bool
 */
function sendMail($address, $title, $content, $host = 'zzzzzzz2zzzzzzz@foxmail.com', $name = 'jan')
{
    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new \PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $host;                 // SMTP username
    $mail->Password = 'zhonanmtgdxlcabj';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom($host, $name);
    $mail->addAddress($address, 'adf');     // Add a recipient

    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $content;
    $mail->CharSet = 'utf-8';
    if (!$mail->send()) {
        return false;
    }
}

