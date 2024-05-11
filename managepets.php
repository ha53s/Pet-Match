<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/addpets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Pets</title>

</head>
<body>

<div class="container">
    <div class="add-pet">
    <h2 class='fas fa-paw'>Add a Pet</h2>
        
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="species">Species:</label>
        <select name="species" id="species" required>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Bird">Bird</option>
        </select>
        <br><br>
        <label for="breed">Breed:</label>
        <input type="text" name="breed" id="breed" required>
        <br><br>
        <label for="age">Age:</label>
        <input type="text" name="age" id="age" required>
        <br><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br><br>
        <label for="image">Image URL:</label>
        <input type="url" name="image" id="image" required>
        <br><br>
        <input type="submit" value="Add Pet">
    </form>
    </div>


    <div class="animal-container">
        <?php
        include './config/db.php'; 

        $sql = "SELECT * FROM Animals";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="animal-box">';
                echo '<img src="' . $row["ImageURL"] . '" alt="' . $row["Name"] . '" class="animal-image">';
                echo '<h3>' . $row["Name"] . '</h3>';
                echo '<p>Age: ' . $row["Age"] . '</p>';
                echo '<p>species: ' . $row["Species"] . '</p>';
                echo '<p>breed: ' . $row["Breed"] . '</p>';
                echo '<p>Description: ' . $row["Description"] . '</p>';
                echo '<p>Availability: ' . ($row["Available"] ? 'Available' : 'Not Available') . '</p>';
                echo '<a href="deletepets.php?id='.$row["AnimalID"].'"><button class = "btn" onclick= confirmAdopt()>Delete</button></a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        
        
        <?php
        include './config/db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
            $species = isset($_POST["species"]) ? trim($_POST["species"]) : "";
            $breed = isset($_POST["breed"]) ? trim($_POST["breed"]) : "";
            $age = isset($_POST["age"]) ? trim($_POST["age"]) : "";
            $description = isset($_POST["description"]) ? trim($_POST["description"]) : "";
            $imageURL = isset($_POST["image"]) ? trim($_POST["image"]) : "";

            $name = mysqli_real_escape_string($conn, $name);
            $species = mysqli_real_escape_string($conn, $species);
            $breed = mysqli_real_escape_string($conn, $breed);
            $age = mysqli_real_escape_string($conn, $age);
            $description = mysqli_real_escape_string($conn, $description);
            $imageURL = mysqli_real_escape_string($conn, $imageURL);

            $sql = "INSERT INTO Animals (Name, Species, Breed, Age, Description, ImageURL) VALUES ('$name', '$species', '$breed', '$age', '$description', '$imageURL')";

            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php?page=mng");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
        ?>

    </div>
</div>

    <script>
        function confirmAdopt() {
            if (confirm("Are you sure you want delete this pet?")) {
                alert("Pet will be deleted");
            } else {
                alert("Deletion canceled.");
                event.preventDefault();
            }
        }
    </script>
    
</body>
</html>
