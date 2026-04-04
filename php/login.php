<?php
session_start();

include "config.php";

// تأكد إن البيانات جاية
if (empty($_POST['email']) || empty($_POST['password'])) {
    die("من فضلك اكتب الإيميل والباسورد ❌");
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

// البحث عن المستخدم
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    // التحقق من الباسورد
    if (password_verify($password, $user['password'])) {

        $_SESSION['name'] = $user['name'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // تحويل حسب نوع المستخدم
        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
            exit();
        } else {
            header("Location: home.php");
            exit();
        }

    } else {
        echo "كلمة السر غلط ❌";
    }

} else {
    echo "الإيميل غير موجود ❌";
}
?>