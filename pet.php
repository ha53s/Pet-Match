<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/pets1.css">
    <title>Animal Details</title>

    <script>
        function confirmAdopt() {
            if (confirm("Are you sure you want to adopt this animal?")) {
                
                alert("Request sent. Someone will contact you shortly.");
            } else {
        
                alert("Adoption canceled.");
            }
        }
    </script>
</head>
<body>

<?php

include 'config/db.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Animals WHERE AnimalID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="animal-details">';
        echo '<h2>' . $row["Name"] . '</h2>';
        echo '<img src="' . $row["ImageURL"] . '" alt="' . $row["Name"] . '" class="animal-image">';
        echo '<p><strong>Species: </strong>' . $row["Species"] . '</p>';
        echo '<p><strong>Breed: </strong>' . $row["Breed"] . '</p>';
        echo '<p><strong>Age: </strong>' . $row["Age"] . '</p>';
        echo '<p><strong>Description: </strong>' . $row["Description"] . '</p>';
        echo '<p><strong>Availability:</strong> ' . ($row["Available"] ? 'Available' : 'Not Available') . '</p>';
        echo '<button class="adopt-button" onclick="confirmAdopt()">Adopt Me</button>';
        echo '</div>';
    } else {
        echo "Animal not found";
    }
} else {
    echo "No animal ID specified";
}
$conn->close();
?>

</body>
</html>
<?php include 'include/footer.php'; ?>
