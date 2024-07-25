<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RBD Access Services for Tournament Admin</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="./ccs/style.css" rel="stylesheet">
    <link href="./ccs/slideshow.css" rel="stylesheet">
    <link href="./ccs/backgroundimage.css" rel="stylesheet">
    <link href="./ccs/jquery.bxslider.css" rel="stylesheet">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.bxslider.js"></script>
</head>

<body>

    <div class="header bg-primary text-white py-4">
        <div class="container text-center">
            <h1 class="display-4">RBD for Tournament Admin</h1>
        </div>
    </div>

    <div class="container mt-3">
        <div class="card-body">
            <?php
            echo "<a href='list_marathon.php' class='btn btn-outline-primary btn-block my-2'>Marathon DB</a>";
            echo "<a href='list_participate.php' class='btn btn-outline-primary btn-block my-2'>Participate DB</a>";
            echo "<a href='list_user.php' class='btn btn-outline-primary btn-block my-2'>User DB</a>";
            ?>

            <!-- Nút quay lại trang user.html -->
            <a href='user.html' class='btn btn-primary btn-block my-2'>Quay lại trang User</a>
        </div>
    </div>

    <div class="container mt-3">
        <?php
        if (isset($_SESSION['UserID'])) {
            $UserID = $_SESSION['UserID'];

            // Thực hiện kiểm tra đăng ký
            // Điều kiện kiểm tra tại đây

            echo "<h2 class='text-center mb-4'>Thông tin đăng ký của UserID: $UserID</h2>";

            // Hiển thị thông tin đăng ký ở đây
            // Ví dụ:
            echo "<div class='text-center'>Đăng ký thành công!</div>";

        } else {
            // Nếu không có UserID trong session, chuyển hướng về trang đăng nhập
            header("Location: login.php");
            exit();
        }
        ?>
    </div>

</body>

</html>
