<?php
include './config/db.php'; 


    if ($_SERVER['REQUEST_METHOD'] === 'post' && isset($_POST['review'])){
        $review= $_POST['review'];
        $username = $_SESSION['username'];
        $customer_reviews= "INSERT INTO customer_reviews (username, review, created_at) VALUES ($username,$review, NOW())";
        $conn->query($customer_reviews);}


    $conn->close(); 

    
    header("Location:reviews.php"); 
    exit();
?>
