<?php
// contact.php - simple mail handler for Bulender
header('Content-Type: text/html; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  echo 'Invalid request';
  exit;
}

$to = 'info@bulender.com'; // <-- change to your real email
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$subject = htmlspecialchars($_POST['subject'] ?? 'New message from site');
$message = htmlspecialchars($_POST['message'] ?? '');

if(!$name || !$email || !$message){
  echo 'يرجى ملء الحقول المطلوبة.';
  exit;
}

$full_subject = 'رسالة من موقع Bulender: ' . $subject;
$body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
$headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

$sent = mail($to, $full_subject, $body, $headers);
if($sent){
  echo '<h2 style="text-align:center;color:green;font-family:Cairo;">تم إرسال رسالتك بنجاح.</h2>';
} else {
  echo '<h2 style="text-align:center;color:red;font-family:Cairo;">حدث خطأ أثناء الإرسال.</h2>';
}
?>