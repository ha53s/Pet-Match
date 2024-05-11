<?php
include 'include/header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $yourName = sanitizeInput($_POST['your_name']);
    $contactNumber = sanitizeInput($_POST['contact_number']);
    $description = sanitizeInput($_POST['description']);
    $location = sanitizeInput($_POST['location']);
    $typeOfPet = sanitizeInput($_POST['type_of_pet']);
    $hasInjury = isset($_POST['has_injury']) ? true : false;
    $injuryDescription = sanitizeInput($_POST['injury_description']);
    $date = date('Y-m-d'); 
    $time = date('H:i:s'); 

    
    if ($yourName && $contactNumber && validateSaudiPhoneNumber($contactNumber)) {
       
        include 'config/db.php';

        $sql = "INSERT INTO pet_reports (type_of_pet, description, location, your_name, contact_number, has_injury, injury_description, report_date, report_time)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisss", $typeOfPet, $description, $location, $yourName, $contactNumber, $hasInjury, $injuryDescription, $date, $time);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo '<p>Thank you for taking the time to report the pet. We appreciate your effort in helping us ensure the well-being of animals.</p>';
    } else {
        if (!validateSaudiPhoneNumber($contactNumber)) {
            echo '<p>Please enter a valid Saudi Arabian phone number.</p>';
        } else {
            echo '<p>Please fill in all the required fields.</p>';
        }
    }
}

function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function validateSaudiPhoneNumber($phoneNumber) {
    
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (strlen($phoneNumber) === 12 && substr($phoneNumber, 0, 3) === '966') {
        return true;
    }

    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/report.css">
    
    <title>Report a Pet</title>
</head>
<body>
    <h1>Report a Pet</h1>
    
    <form method="POST" action="">
        <label for="type_of_pet">Type of Pet:</label>
        <input type="text" id="type_of_pet" name="type_of_pet" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>
        
        <label for="your_name">Your Name:</label>
        <input type="text" id="your_name" name="your_name" required><br><br>
        
        <label for="contact_number">Contact Number (Saudi Arabia):</label>
        <input type="text" id="contact_number" name="contact_number" pattern="[0-9]{12}" required
               title="Please enter a valid Saudi Arabian phone number (e.g., 966XXXXXXXXX)"><br><br><br>

        <label for="has_injury">Does the pet have any injuries?</label>
        <input type="checkbox" id="has_injury" name="has_injury"><br><br>
        
        <label for="injury_description">Injury Description:</label><br>
        <textarea id="injury_description" name="injury_description" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php include 'include/footer.php'; ?>