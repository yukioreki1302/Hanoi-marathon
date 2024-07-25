<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reception System</title>
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
    body {
        background-color: #f8f9fa;
    }

    .header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    .header p {
        font-size: 36px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* Center the form button and link */
    .btn-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>

    <div class="header">
        <p>Participation Declaration</p>
    </div>

    <div class="container">
        <?php
        function getMarathonID()
        {
            $user = 'root';
            $password = '';
            $dbName = '21110112';
            $host = 'localhost:3306';
            $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

            try {
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT MarathonID FROM marathon";
                $stm = $pdo->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($result)) {
                    $row = end($result);
                    return $row['MarathonID'] + 1;
                } else {
                    return 1;
                }
            } catch (Exception $e) {
                echo '<span class="error">Error</span><br>';
                echo $e->getMessage();
                exit();
            }
        }

        $MID = getMarathonID();
        ?>

        <form method="POST" action="marathon_regist.php">
            <div class="form-group">
                <label for="MarathonID">MarathonID</label>
                <input type="text" class="form-control" id="MarathonID" name="MarathonID" value="<?php echo $MID; ?>">
            </div>
            <div class="form-group">
                <label for="RaceName">RaceName</label>
                <input type="text" class="form-control" id="RaceName" name="RaceName">
            </div>
            <div class="form-group">
                <label for="Date">Date of the event</label>
                <input type="date" class="form-control" id="Date" name="Date">
            </div>

            <!-- Centering the Submit button -->
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>

        <!-- Centering the link -->
        <a href="DBcontent.php" class="btn btn-primary btn-block mt-2"> DB contents</a>
    </div>

</body>

</html>
