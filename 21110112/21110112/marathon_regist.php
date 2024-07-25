<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registration for Participation</title>
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
$data['RaceName'] = $_POST["RaceName"];
$data['Date'] = $_POST["Date"];

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

    $sql = "INSERT INTO marathon (MarathonID, RaceName, Date) 
            VALUES(:MarathonID, :RaceName, :Date)";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':MarathonID', $data['MarathonID'], PDO::PARAM_STR);
    $stm->bindValue(':RaceName', $data['RaceName'], PDO::PARAM_STR);
    $stm->bindValue(':Date', $data['Date'], PDO::PARAM_STR);

    $stm->execute();
} catch (Exception $e) {
    echo '<span class="error">Error</span><br>';
    echo $e->getMessage();
    exit();
}
?> 

<div>
    <a href="tournament_admin.php">Go to the top page</a>
</div>

</body>
</html>
