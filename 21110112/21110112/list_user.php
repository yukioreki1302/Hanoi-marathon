<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List Participate DB</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="./ccs/style.css" rel="stylesheet">
    <link href="./ccs/slideshow.css" rel="stylesheet">
    <link href="./ccs/backgroundimage.css" rel="stylesheet">
    <link href="./ccs/jquery.bxslider.css" rel="stylesheet">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.bxslider.js"></script>
</head>

<style>
    .header .topimage {
        text-align: center;
        padding: 20px;
    }

    .header .topimage p {
        font-size: 36px;
        color: #28a745;
    }
</style>

<body>

    <div class="header bg-dark">
        <div class="topimage">
            <p class="text-white">List Participate DB</p>
        </div>
    </div>

    <?php
    $user = 'root';
    $password = '';
    $dbName = '21110112';
    $host = 'localhost:3306';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected to {$dbName}";

        $sql = "SELECT participate.UserID, user.Name, participate.TimeRecord, user.Nationality, user.Address
        FROM participate
        INNER JOIN user ON participate.UserID = user.UserID;";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo '<span class="error">Error</span><br>';
        echo $e->getMessage();
        exit();
    }
    ?>

    <div class="container mt-3">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Best Record</th>
                    <th>Nationality</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row['UserID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['TimeRecord']; ?></td>
                        <td><?php echo $row['Nationality']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-3">
        <a class="btn btn-success btn-go-to-dbcontent" href="DBcontent.php">Go Back</a>
    </div>

</body>
</html>
