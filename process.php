<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // التحقق من وجود بيانات وعدم وجود أسطر جديدة غير متوقعة
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "عذرًا، يبدو أن هناك مشكلة في البيانات التي أرسلتها.";
        exit;
    }

    $to = "anasqurishi21@gmail.com"; // ضع بريدك الإلكتروني هنا
    $subject = "نموذج اتصال جديد من: $name";
    $body = "الاسم: $name\n";
    $body .= "البريد الإلكتروني: $email\n\n";
    $body .= "الرسالة:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // إرسال البريد الإلكتروني
    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo "تم إرسال رسالتك بنجاح!";
    } else {
        http_response_code(500);
        echo "عذرًا، حدث خطأ أثناء إرسال رسالتك.";
    }

} else {
    http_response_code(403);
    echo "حدث خطأ ما، يرجى المحاولة مرة أخرى.";
}
?>
