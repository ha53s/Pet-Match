<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/reports.css">
    <title>Reported Pets</title>
</head>
    

<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Location</th>
            <th>Your Name</th>
            <th>Contact Number</th>
            <th>Injury</th>
            <th>Injury Description</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php
        include './config/db.php';

        $sql = "SELECT * FROM pet_reports";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["type_of_pet"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["your_name"] . "</td>";
                echo "<td>" . $row["contact_number"] . "</td>";
                echo "<td>" . ($row["has_injury"] ? "Yes" : "No") . "</td>";
                echo "<td>" . $row["injury_description"] . "</td>";
                echo "<td>" . $row["report_date"] . "</td>";
                echo "<td>" . $row["report_time"] . "</td>";
                echo "<td>";
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                echo "<input type='hidden' name='report_id' value='" . $row["id"] . "'>";
                echo "<input name='choice' type='submit' value='Select'>";
                echo "<input name='choice' type='submit' value='Reject'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No pet reports found</td></tr>";
        }
        ?>
    </table>
    <br><br>
        <form id='addpet' action="" method="post" hidden>
            <label id='information' hidden>Please Complete The Information</label>
            <br><br>
            <input type="hidden" name="report_id" id="report_id">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br><br>
            <label for="species">Species:</label>
            <input type="text" name="species" id="species" required>
            <br><br>
            <label for="breed">Breed:</label>
            <input type="text" name="breed" id="breed" required>
            <br><br>
            <label for="age">Age:</label>
            <input type="text" name="age" id="age" required>
            <br><br>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
            <br><br>
            <label for="image">Image URL:</label>
            <input type="url" name="image" id="image" required>
            <br><br>
            <input type="submit" value="Submit">
        </form>
    
    
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'], $_POST['choice'])) {
    $report_id = $_POST['report_id'];
    $choice = $_POST['choice'];
    
    if ($choice === 'Select') {
        displayReport($conn, $report_id);
        
    } elseif ($choice === 'Reject') {
        $success = deleteReportById($conn, $report_id);
        if ($success) {
            echo "<script>window.location.href = 'admin.php?page=rep';</script>";
        } else {
            echo "Error deleting report.";
        }
    } else {
        echo "Invalid action.";
    }
}

function fetchReportById($conn, $report_id) {
    $sql = "SELECT * FROM pet_reports WHERE id = $report_id";
    $result = $conn->query($sql);
    return ($result->num_rows == 1) ? $result->fetch_assoc() : null;
}
    
function displayReport($conn, $report_id) {
    $report = fetchReportById($conn, $report_id);
    if ($report) {
        echo "<script>document.getElementById('information').removeAttribute('hidden');</script>";
        echo "<script>document.getElementById('addpet').removeAttribute('hidden');</script>";
        echo "<script>document.getElementById('report_id').value='".htmlspecialchars($report_id, ENT_QUOTES)."';</script>";
        echo "<script>document.getElementById('species').value='".htmlspecialchars($report['type_of_pet'], ENT_QUOTES)."';</script>";
        echo "<script>document.getElementById('description').value='".htmlspecialchars($report['description'], ENT_QUOTES)."';</script>";
    } else {
        echo "Report not found.";
    }
}

function deleteReportById($conn, $report_id) {
    $sql = "DELETE FROM pet_reports WHERE id = $report_id";
    return $conn->query($sql);
}
?>

    <script>
        document.getElementById('addpet').addEventListener('submit', function(event) {
        event.preventDefault();
        acceptReport();
    });

    function acceptReport() {

<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'],$_POST['name'], $_POST['species'], $_POST['breed'], $_POST['age'], $_POST['description'], $_POST['image'])) {
        
            $stmt = $conn->prepare("INSERT INTO Animals (Name, Species, Breed, Age, Description, ImageURL) VALUES (?, ?, ?, ?, ?, ?)");
            
            $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
            $species = isset($_POST['species']) ? mysqli_real_escape_string($conn, $_POST['species']) : '';
            $breed = isset($_POST['breed']) ? mysqli_real_escape_string($conn, $_POST['breed']) : '';
            $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
            $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
            $image = isset($_POST['image']) ? mysqli_real_escape_string($conn, $_POST['image']) : '';
            $report_id = $_POST['report_id'];

            
            $stmt->bind_param("ssssss", $name, $species, $breed, $age, $description, $image);
            
            if ($stmt->execute() === TRUE) {
                $success = deleteReportById($conn, $report_id);
                if ($success) {
                    echo "<script>window.location.href = 'admin.php?page=rep';</script>";
                } else {
                    echo "Error deleting report.";
                }
            } else {
                echo "Error adding pet to Animals table: " . $conn->error;
            }
        } else {
            echo "Complete all data";
        }
?>
    }
    </script>
    
    <?php $conn->close(); ?>
    
    </body>
</html>

