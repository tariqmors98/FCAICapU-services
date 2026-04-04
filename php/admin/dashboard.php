<?php
session_start();
include "../config.php";

// 🔐 تأكد إن المستخدم مسجل دخول
if (!isset($_SESSION['id'])) {
    header("Location: ../login.html");
    exit();
}

// 🔐 تأكد إنه أدمن
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.html");
    exit();
}

// 📊 إجمالي التبرعات
$donations = $conn->query("SELECT SUM(amount) as total FROM donations")->fetch_assoc();

// 👥 المستخدمين
$users = $conn->query("SELECT * FROM users");

// 💰 آخر التبرعات
$latest = $conn->query("
    SELECT users.name, donations.amount, donations.created_at 
    FROM donations 
    JOIN users ON donations.user_id = users.id 
    ORDER BY donations.id DESC 
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center">
        <h2>📊 لوحة تحكم الأدمن</h2>
        <a href="../logout.php" class="btn btn-danger">تسجيل خروج</a>
    </div>

    <!-- إحصائيات -->
    <div class="alert alert-primary mt-3">
        عدد المستخدمين: <?php echo $users->num_rows; ?>
    </div>

    <div class="alert alert-success">
        إجمالي التبرعات: <?php echo $donations['total'] ?? 0; ?> جنيه 💰
    </div>

    <!-- آخر التبرعات -->
    <h4 class="mt-4">💰 آخر التبرعات</h4>
    <table class="table table-bordered">
        <tr>
            <th>الاسم</th>
            <th>المبلغ</th>
            <th>التاريخ</th>
        </tr>

        <?php while($row = $latest->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['amount']; ?> جنيه</td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <!-- المستخدمين -->
    <h4 class="mt-4">👥 المستخدمين</h4>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>الاسم</th>
            <th>الإيميل</th>
            <th>حذف</th>
        </tr>

        <?php while($row = $users->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
                    حذف
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>