<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List Participate</title>
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
            <p class="text-white">LIST PARTICIPATE</p>
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

        $sql = "SELECT MarathonID, UserID, EntryNO, Hotel, TimeRecord, Standings FROM participate";
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
                    <th>ParticipateID</th>
                    <th>MarathonID</th>
                    <th>UserID</th>
                    <th>EntryNO</th>
                    <th>Hotel</th>
                    <th>TimeRecord</th>
                    <th>Standings</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row['UserID']; ?></td>
                        <td><?php echo $row['MarathonID']; ?></td>
                        <td><?php echo $row['UserID']; ?></td>
                        <td><?php echo $row['EntryNO']; ?></td>
                        <td><?php echo $row['Hotel']; ?></td>
                        <td><?php echo $row['TimeRecord']; ?></td>
                        <td><?php echo $row['Standings']; ?></td>
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
