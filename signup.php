<?php
include 'config/db.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    
    $check_username = "SELECT * FROM Users WHERE Username='$username'";
    $check_email = "SELECT * FROM Users WHERE Email='$email'";
    $result_username = $conn->query($check_username);
    $result_email = $conn->query($check_email);

    if ($result_username->num_rows > 0) {
        $error_message = "Username already exists.";
    } elseif ($result_email->num_rows > 0) {
        $error_message = "Email already exists.";
    } else {
       
        if (!ctype_alnum($username)) {
            $error_message = "Username must contain only alphanumeric characters.";
        } else {
         
            $salt = md5(uniqid(mt_rand(), true));

           
            $hashed_password = md5($password . $salt);

          
            $sql = "INSERT INTO Users (Username, Password, Salt, Email) VALUES ('$username', '$hashed_password', '$salt', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 5000);</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-paw"></i>Sign Up</h1>
        <?php if ($error_message !== ""): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
            <div class="paragraph">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
            </div>
            <div class="paragraph">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br>
            </div>
            <div class="paragraph">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
            </div>
            <div class="error"></div>
            <div class="btn-container">
                <p class ="val"> </p>
                <button type="submit" class="btn">Sign Up</button>
            </div>
        </form>
    </div>
    <script src="scripts/signValidate.js"></script>
</body>
</html>
