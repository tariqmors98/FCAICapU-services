<?php
$conn = new mysqli("localhost", "root", "", "college_funding");

// تأكد من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// دعم اللغة العربية
$conn->set_charset("utf8mb4");
?>