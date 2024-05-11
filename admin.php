<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/admins.css">
    <link href="https://fonts.cdnfonts.com/css/the-animals" rel="stylesheet">
    
    <title> Admin Panel </title>
</head>

<body>
    <nav class ="sidebar active">
        <div class="top">
            <div class="logo">
                <span id="name">PetMatch</span>
            </div>
            <i class="fas fa-bars" id="btn"></i>
        </div>
        <div class='user'>
            <p class='bold'>Welcome Back Admin</p>
            <p id='current'></p>
            <?php
                session_start();
                if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];
                    echo "<script>document.getElementById('current').innerHTML='$username';</script>";
                }
            ?>
        </div>
        <ul>
            <li>
                <a href="#" data-page="reports.php" id='rep'>
                    <i class="fas fa-hand-holding-heart"></i>
                    <span class='nav-item'> Reports </span>
                </a>
                <span class='tooltip'> Reports </span>
            </li>
            <li>
                <a href="#" data-page="managepets.php" id='mng'>
                    <i class="fas fa-paw"></i>
                    <span class='nav-item'> Pets </span>
                </a>
                <span class='tooltip'> Pets </span>
            </li>
            <li>
                <a href="logoutadmin.php" id='logout'>
                    <i class="fas fa-door-open"></i>
                    <span class='nav-item'> Logout </span>
                </a>
                <span class='tooltip'> Logout </span>
            </li>
        </ul>
    </nav>
    
    <div class="main-content">
        <div class="main-container" id="content">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : '';
            switch($page) {
            case 'mng':
                include 'managepets.php';
                break;
                
            default:
                include 'reports.php';
                break;
            }
            ?>
        </div>
    </div>
</body>
    
<script src="scripts/admin.js"></script>
    
</html>
