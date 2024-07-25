<?php
session_start();

if (isset($_SESSION['UserID'])) {
    // Nếu đã đăng nhập, chuyển hướng đến trang chính
    header("Location: check_regist.php");
    exit();
}

// Kiểm tra xem có dữ liệu được gửi từ form hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối CSDL và kiểm tra thông tin đăng nhập
    $user = 'root';
    $password = '';
    $dbName = '21110112';
    $host = 'localhost:3306';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Lấy dữ liệu từ form
        $inputUserID = $_POST['UserID'];
        $inputPassword = $_POST['Password'];

        // Kiểm tra đăng nhập
        $sql = "SELECT * FROM user WHERE UserID = :UserID AND Password = :Password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':UserID', $inputUserID, PDO::PARAM_STR);
        $stmt->bindParam(':Password', $inputPassword, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Đăng nhập thành công, lưu UserID vào session và chuyển hướng đến trang chính
            $_SESSION['UserID'] = $user['UserID'];
            header("Location: check_regist.php");
            exit();
        } else {
            // Đăng nhập không thành công, thông báo lỗi
            $loginError = "UserID hoặc mật khẩu không đúng.";
        }
    } catch (Exception $e) {
        echo '<span class="error">Error</span><br>';
        echo $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
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
            <h1 class="display-4">Login</h1>
        </div>
    </div>

    <div class="container mt-3">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="UserID">UserID:</label>
                <input type="text" class="form-control" id="UserID" name="UserID" required>
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" id="Password" name="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <?php
        if (isset($loginError)) {
            echo '<div class="alert alert-danger mt-3">' . $loginError . '</div>';
        }
        ?>
    </div>

</body>

</html>
