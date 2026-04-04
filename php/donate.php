<?php
session_start();
include "config.php";

// تأكد إن المستخدم مسجل دخول
if (!isset($_SESSION['id'])) {
    header("Location: ../html/login.html");
    exit();
}

// تأكد إن المبلغ موجود
if (empty($_POST['amount']) || $_POST['amount'] <= 0) {
    die("من فضلك أدخل مبلغ صحيح ❌");
}

$amount = intval($_POST['amount']);
$user_id = $_SESSION['id'];

// إدخال التبرع
$sql = "INSERT INTO donations (user_id, amount) VALUES ($user_id, $amount)";

if ($conn->query($sql) === TRUE) {
    echo "تم التبرع بنجاح ❤️";
} else {
    echo "حصل خطأ: " . $conn->error;
}
?>