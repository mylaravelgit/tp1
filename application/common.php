<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailto($to,$title,$content){
// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.163.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        //$mail->Username = '1021513892@qq.com';                // SMTP 用户名  即邮箱的用户名
//        $mail->Password = 'lcirxbwdtwjqbfdg';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->Username = 'leruge@163.com';                // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'Ai157511';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)

        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom('leruge@163.com', '天空的雾');
            $mail->addAddress($to);
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        //$mail->addReplyTo('xxxx@163.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送

        //发送附件
        // $mail->addAttachment('../xy.zip');         // 添加附件
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

        //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = $content;


        return $mail->send();
    } catch (Exception $e) {
        exception($mail->ErrorInfo,1001);
    }
//$mail = new PHPMailer(true);
//
//try {
//    //Server settings
//
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//    $mail->isSMTP();                                            // Send using SMTP
//    $mail->Host       = 'smtp.qq.com';                    // Set the SMTP server to send through
//    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//    $mail->Username   = '1021513892@qq.com';                     // SMTP username
//    $mail->Password   = 'lcirxbwdtwjqbfdg';                               // SMTP password
//    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
//    $mail->Port       = 465;                                    // TCP port to connect to
//
//
//    //Recipients
//    $mail->setFrom('1021513892@qq.com', '天空的雾');
//    $mail->addAddress($to);     // Add a recipient
//
//
//    // Content
//    $mail->isHTML(true);                                  // Set email format to HTML
//    $mail->Subject = $title;
//    $mail->Body    = $content;
//
//    return $mail->send();
//
//} catch (Exception $e) {
//    exception($mail->ErrorInfo,1001);
//}

}