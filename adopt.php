<?php include 'include/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/adoptpet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Find Your Pet</title>

</head>
<body>

<div class="header">
    <h1 class='fas fa-cat'> Find Your Pet</h1>
</div>

<div class="container">
    <div class="filter-bar">
        <h2 class='fas fa-paw'>Filters</h2>
        <form action="" method="GET">
            <label for="breed">Breed:</label>
            <select name="breed" id="breed">
                <option value="">Any</option>
                <option value="Labrador">Labrador</option>
                <option value="Persian cat">Persian cat</option>
                <option value="Bulldog">Bulldog</option>
                
            </select>
            <br><br>
            <label for="age">Age:</label>
            <select name="age" id="age">
                <option value="">Any</option>
                <option value="months">Young</option>
                <option value="year">Adult</option>

                
            </select>
            <br><br>
            <label for="species">Species:</label>
            <select name="species" id="species">
                <option value="">Any</option>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Bird">Bird</option>
                
            </select>
            <br><br>
            <input type="submit" value="Apply Filters">
        </form>
    </div>

    <div class="animal-container">
        <?php
             include 'config/db.php'; 


        
        $sql = "SELECT * FROM Animals WHERE Available = 1";

        
        if(isset($_GET['breed']) && !empty($_GET['breed'])) {
            $breed = $_GET['breed'];
            $sql .= " AND Breed LIKE '%$breed%'";
        }

        if(isset($_GET['age']) && !empty($_GET['age'])) {
            $age = $_GET['age'];
            $sql .= " AND Age LIKE '%$age%'";
        }

        if(isset($_GET['species']) && !empty($_GET['species'])) {
            $species = $_GET['species'];
            $sql .= " AND Species LIKE '%$species%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="animal-box">';
                echo '<img src="' . $row["ImageURL"] . '" alt="' . $row["Name"] . '" class="animal-image">';
                echo '<h3>' . $row["Name"] . '</h3>';
                echo '<p>Age: ' . $row["Age"] . '</p>';
                echo '<p>Availability: ' . ($row["Available"] ? 'Available' : 'Not Available') . '</p>';
                echo '<a href="pet.php?id=' . $row["AnimalID"] . '"><button class = "btn">Read More</button></a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
<?php include 'include/footer.php'; ?>
