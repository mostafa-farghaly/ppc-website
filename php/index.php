<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جمع البيانات من النموذج
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $floor_type = htmlspecialchars($_POST['floor-type']);
    $sub_category = htmlspecialchars($_POST['sub-category']);
    $area = htmlspecialchars($_POST['area']);
    $message = htmlspecialchars($_POST['message']);
    
    // إعداد عنوان البريد والمحتوى
    $to = "wwwweerry09@gmail.com";
    $subject = "New Quote Request";
    
    // تنسيق الرسالة
    $body = "
    <h2>Quote Request Details</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Type of Flooring:</strong> $floor_type</p>
    <p><strong>Sub Category:</strong> $sub_category</p>
    <p><strong>Area:</strong> $area sq meters</p>
    <p><strong>Message:</strong> $message</p>
    ";
    
    // إعداد رؤوس البريد
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    
    // إرسال البريد الإلكتروني
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Message sending failed.";
    }
}


// تضمين الملفات الضرورية يدويًا
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';
require 'libs/PHPMailer/src/Exception.php';

// استخدام مكتبة PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// إنشاء كائن PHPMailer
$mail = new PHPMailer(true);

try {
    // إعدادات الخادم SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // بريدك الإلكتروني
    $mail->Password = 'yourpassword'; // كلمة المرور
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // إعداد البريد الإلكتروني
    $mail->setFrom('your-email@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // عنوان البريد الإلكتروني للمرسل إليه

    // محتوى البريد الإلكتروني
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // إرسال البريد الإلكتروني
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
