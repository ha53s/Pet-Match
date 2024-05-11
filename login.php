<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-paw"></i>Login</h1>
        <?php
        session_start();
        include 'config/db.php';

        $error_message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM Users WHERE Username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashed_password = md5($password . $row['Salt']); 

                if ($hashed_password === $row['Password']) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['Username'];
                    header("Location: about.php");
                    exit();
                } else {
                    $error_message = "Invalid username or password";
                }
            } else {
                $error_message = "Invalid username or password";
            }
        }
        ?>
        <form action="login.php" method="post" onsubmit="return validateForm()">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <span id="error-message" class="error-message"><?php echo $error_message; ?></span><br><br>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    <script src="scripts/LogValidate.js"></script>
</body>

</html>



