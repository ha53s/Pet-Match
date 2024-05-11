<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Login</title>
</head>
    
<body>
    <div class="container">
        <h1><i class="fas fa-paw"></i> Admin Login</h1>
        <?php
            session_start();
            include './config/db.php';

            $error_message = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
                $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

                $stmt = mysqli_prepare($conn, "SELECT * FROM Admins WHERE Username=?");
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);


                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $hashed_password = md5($password);

                    if ($hashed_password === $row['Password']) {
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['Username'];
                        header("Location: admin.php?page=mng");
                        exit();
                    } else {
                        $error_message = "Invalid username or password";
                    }
                } else {
                    $error_message = "Invalid username or password";
                }   
                $stmt->close();
            }
        ?>
        <form action="logadmin.php" method="post" onsubmit="return validateForm()">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <span id="error-message" class="error-message"><?php echo $error_message; ?></span><br><br>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    <script src="./scripts/LogValidate.js"></script>
</body>

</html>



