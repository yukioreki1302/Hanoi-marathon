<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reception System</title>
    <link href="./ccs/style.css" rel="stylesheet">
    <link href="./ccs/slideshow.css" rel="stylesheet">
    <link href="./ccs/backgroundimage.css" rel="stylesheet">
    <link href="./ccs/jquery.bxslider.css" rel="stylesheet">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.bxslider.js"></script>
</head>

<body>
    <?php
    $data['UserID'] = $_POST["UserID"];
    $_SESSION["UserID"] = $_POST["UserID"];
    $data['Name'] = $_POST["Name"];
    $data['BestRecord'] = $_POST["BestRecord"];
    $data['Nationality'] = $_POST["Nationality"];
    $data['PassportNO'] = $_POST["PassportNO"];
    $data['Sex'] = $_POST["Sex"];
    $data['Age'] = $_POST["Age"];
    $data['email'] = $_POST["email"];
    $data['Phone'] = $_POST["Phone"];
    $data['Address'] = $_POST["Address"];

    $user = 'root';
    $password = '';
    $dbName = '21110112';
    $host = 'localhost:3306';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected to {$dbName}";

        $sql = "INSERT INTO user (UserId, Name, BestRecord, Nationality, PassportNo, Sex, Age, email, Phone, Address )
                VALUES(:UserID, :Name, :BestRecord, :Nationality, :PassportNO, :Sex, :Age, :email, :Phone, :Address )";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(':UserID', $data['UserID'], PDO::PARAM_STR);
        $stm->bindValue(':Name', $data['Name'], PDO::PARAM_STR);
        $stm->bindValue(':BestRecord', $data['BestRecord'], PDO::PARAM_STR);
        $stm->bindValue(':Nationality', $data['Nationality'], PDO::PARAM_STR);
        $stm->bindValue(':PassportNO', $data['PassportNO'], PDO::PARAM_STR);
        $stm->bindValue(':Sex', $data['Sex'], PDO::PARAM_STR);
        $stm->bindValue(':Age', $data['Age'], PDO::PARAM_STR);
        $stm->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stm->bindValue(':Phone', $data['Phone'], PDO::PARAM_STR);
        $stm->bindValue(':Address', $data['Address'], PDO::PARAM_STR);
        $stm->execute();
    } catch (Exception $e) {
        echo '<span class="error">Error</span><br>';
        echo $e->getMessage();
        exit();
    }
    ?>
    <div>
        <a href="marathon_entry.php">Register please </a>
    </div>

</body>

</html>
