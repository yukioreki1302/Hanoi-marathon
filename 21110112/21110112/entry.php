<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>registration for participation</title>
    <link href="./ccs/style.css" rel="stylesheet">
    <link href="./ccs/slideshow.css" rel="stylesheet">
    <link href="./ccs/backgroundimage.css" rel="stylesheet">
    <link href="./ccs/jquery.bxslider.css" rel="stylesheet">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.bxslider.js"></script>
</head>

<body>

<?php
$data['MarathonID'] = $_POST["MarathonID"];
$data['UserID'] = $_POST["UserID"];
$_SESSION["UserID"] = $_POST["UserID"];
$data['EntryNO'] = $_POST["EntryNO"];
$data['Hotel'] = $_POST["Hotel"];
$data['TimeRecord'] = $_POST["TimeRecord"];
$data['Standings'] = $_POST["Standings"];

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

    $sql = "INSERT INTO participate (MarathonID, UserID, EntryNO, Hotel, TimeRecord, Standings) 
            VALUES(:MarathonID, :UserID, :EntryNO, :Hotel, :TimeRecord, :Standings)";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':MarathonID', $data['MarathonID'], PDO::PARAM_STR);
    $stm->bindValue(':UserID', $data['UserID'], PDO::PARAM_STR);
    $stm->bindValue(':EntryNO', $data['EntryNO'], PDO::PARAM_STR);
    $stm->bindValue(':Hotel', $data['Hotel'], PDO::PARAM_STR);
    $stm->bindValue(':TimeRecord', $data['TimeRecord'], PDO::PARAM_STR);
    $stm->bindValue(':Standings', $data['Standings'], PDO::PARAM_STR);
    $stm->execute();
} catch (Exception $e) {
    echo '<span class="error">Error</span><br>';
    echo $e->getMessage();
    exit();
}
?>
<div>
    <a href="user.html">Go to the top page</a>
</div>

</body>
</html>
