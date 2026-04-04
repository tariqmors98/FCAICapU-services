<?php
include "config.php";

// تأكد إن البيانات جاية
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
    die("من فضلك املأ كل الحقول ❌");
}

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// 🔍 تحقق هل الإيميل موجود
$check = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($check->num_rows > 0) {
    die("الإيميل مستخدم بالفعل ❌");
}

// ✅ تسجيل المستخدم
$sql = "INSERT INTO users (name, email, password)
        VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.html");
    exit();
} else {
    echo "حصل خطأ: " . $conn->error;
}
?>