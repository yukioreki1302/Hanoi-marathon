<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style2.css" rel="stylesheet"> <!-- Add new stylesheet link -->
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">User Registration</h2>

        <?php
        function checked(string $value, array $checkedValues)
        {
            $isChecked = in_array($value, $checkedValues);
            if ($isChecked) {
                echo "checked";
            }
        }

        function getUserID()
        {
            $user = 'root';
            $password = '';
            $dbName = '21110112';
            $host = 'localhost:3306';
            $dsn = "mysql:host={$host}; dbname={$dbName};charset=utf8";
            try {
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT UserID, Name FROM user";
                $stm = $pdo->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo '<span class="error">Error</span><br>';
                echo $e->getMessage();
                exit();
            }

            if (!empty($result)) {
                $row = end($result);
                return $row['UserID'] + 1;
            } else {
                return 1;
            }
        }

        $Sex = "male";
        $UID = getUserID();
        $_SESSION["UserID"] = $UID;
        ?>

        <form name="registrationForm" method="POST" action="user_regist.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="UserID">UserID</label>
                <input type="text" class="form-control" name="UserID" value="<?php echo $UID; ?>" readonly required>
            </div>

            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="nameInput" required>
                <small id="nameError" class="text-danger"></small>
            </div>


            <div class="form-group">
                <label for="BestRecord">BestRecord</label>
                <input type="text" class="form-control" name="BestRecord" placeholder="2:30:40">
            </div>

            <div class="form-group">
                <label for="Nationality">Nationality</label>
                <input type="text" class="form-control" name="Nationality" required>
            </div>

            <div class="form-group">
                <label for="PassportNO">PassportNO</label>
                <input type="text" class="form-control" name="PassportNO" required>
            </div>

            <div class="form-group">
                <label>Sex:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="Sex" value="male" <?php checked("male", [$Sex]); ?> required>
                    <label class="form-check-label">Male</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="Sex" value="female" <?php checked("female", [$Sex]); ?> required>
                    <label class="form-check-label">Female</label>
                </div>
            </div>

            <div class="form-group">
                <label for="Age">Age</label>
                <input type="number" class="form-control" name="Age" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="tel" class="form-control" name="Phone" required>
            </div>

            <div class="form-group">
                <label for="Address">Address</label>
                <textarea class="form-control" name="Address" rows="3" placeholder="Address please" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <script src="./js/validation.js"></script>
</body>

</html>
