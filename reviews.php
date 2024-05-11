<?php include 'include/header.php'; ?>
<link rel="stylesheet"  href="css/reviews.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
</head>
<body>
    <div class="container">
        <div class="board">
            <h2 class="text-light" textalign=center >Word from our Friends</h2>
            <?php
                include './config/db.php';

                $sql = "SELECT * FROM customer_reviews";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='review-box'>";
                        echo "<p>User ID: " . $row["user_id"] . "</p>";
                        echo "<p>Review: " . $row["review"] . "</p>";
                        echo "<p>Created At: " . $row["created_at"] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No reviews</p>";
                }
            ?>
        </div>
    </div>
    
    <div class="container">
        <div class="board">
            <div class="review-form">
                <h3>Write a Review:</h3>
                <form action="submitR.php" method="post">
                    <textarea name="review" class="review-input" rows="4" placeholder="Your Review" required></textarea><br>
                    <input type="submit" value="Submit Review">
                </form>
            </div>
        </div>
    </div>
    
<?php include 'include/footer.php'; ?>
</body>
</html>
