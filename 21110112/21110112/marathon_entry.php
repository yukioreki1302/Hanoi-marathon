<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registration for Participation</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/slideshow.css" rel="stylesheet">
    <link href="./css/backgroundimage.css" rel="stylesheet">
    <link href="./css/jquery.bxslider.css" rel="stylesheet">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.bxslider.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function validateForm() {
            var entryNo = document.forms["participationForm"]["EntryNO"].value;
            var timeRecord = document.forms["participationForm"]["TimeRecord"].value;
            var standings = document.forms["participationForm"]["Standings"].value;
            var age = document.forms["participationForm"]["Age"].value;
            var email = document.forms["participationForm"]["email"].value;

            if (entryNo === "" || timeRecord === "" || standings === "" || age === "" || email === "") {
                alert("All fields must be filled out");
                return false;
            }

            if (isNaN(age) || age <= 0) {
                alert("Age must be a positive number");
                return false;
            }

            if (isNaN(entryNo) || entryNo <= 0) {
                alert("EntryNO must be a positive number");
                return false;
            }

            // Check for valid email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailRegex)) {
                alert("Invalid email format");
                return false;
            }

            // Check for valid TimeRecord format (hh:mm:ss)
            var timeRecordRegex = /^\d{2}:\d{2}:\d{2}$/;
            if (!timeRecord.match(timeRecordRegex)) {
                alert("Invalid TimeRecord format. Use hh:mm:ss");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="header">
        <h2 class="display-4">Participation Declaration</h2>
    </div>

    <?php
    function MarathonIDoption()
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
            $sql = "SELECT MarathonID, RaceName FROM marathon";
            $stm = $pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo '<span class="error">Error</span><br>';
            echo $e->getMessage();
            exit();
        }

        echo '<select name="MarathonID" class="form-control">';
        foreach ($result as $row) {
            echo "<option value={$row['MarathonID']}>{$row['RaceName']}</option>", PHP_EOL;
        }
        echo '</select>';
    }

    $SID = $_SESSION["UserID"];
    ?>

    <div class="container form-container">
        <form name="participationForm" method="POST" action="entry.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="ParticipateID">ParticipateID:</label>
                <input type="text" class="form-control" name="ParticipateID" value="<?php echo $SID; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="MarathonID">MarathonID:</label>
                <?php MarathonIDoption(); ?>
            </div>

            <div class="form-group">
                <label for="UserID">UserID</label>
                <input type="text" class="form-control" name="UserID" value="<?php echo $SID; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="EntryNO">EntryNO</label>
                <input type="text" class="form-control" name="EntryNO">
            </div>

            <div class="form-group">
                <label for="Hotel">Hotel</label>
                <input type="text" class="form-control" name="Hotel">
            </div>

            <div class="form-group">
                <label for="TimeRecord">TimeRecord</label>
                <input type="text" class="form-control" name="TimeRecord" placeholder="2:30:40">
            </div>

            <div class="form-group">
                <label for="Standings">Standings</label>
                <input type="text" class="form-control" name="Standings">
            </div>

            <div class="form-group">
                <label for="Age">Age</label>
                <input type="text" class="form-control" name="Age">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email">
            </div>

            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" class="form-control" name="Phone">
            </div>

            <div class="form-group">
                <label for="Address">Address</label>
                <textarea class="form-control" name="Address" rows="3" placeholder="Address please"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
