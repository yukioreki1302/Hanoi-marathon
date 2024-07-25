<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List Races</title>
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

<div class="header bg-success text-white py-4">
    <div class="container text-center">
        <h1 class="display-4">List Races</h1>
    </div>
</div>

<?php
$user = 'root';
$password = '';
$dbName = '21110112';
$host = 'localhost:3306';
$dsn= "mysql:host={$host};dbname={$dbName};charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT MarathonID, RaceName, Date FROM marathon";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo '<span class="error">Error</span><br>';
    echo $e->getMessage();
    exit();
}
?>

<!-- Use Bootstrap classes for styling the table -->
<div class="container mt-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>MarathonID</th>
                <th>RaceName</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['MarathonID']; ?></td>
                    <td><?php echo isset($row['RaceName']) ? $row['RaceName'] : ''; ?></td>
                    <td><?php echo isset($row['Date']) ? $row['Date'] : ''; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="text-center mt-3">
    <a class="btn btn-primary" href="DBcontent.php">Go Back</a>
</div>

</body>
</html>
