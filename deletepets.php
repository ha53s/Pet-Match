<?php
    include './config/db.php';


        if (isset($_GET["id"])) {

            $animal_id = $_GET["id"];

 
            $sql = "DELETE FROM Animals WHERE AnimalID = $animal_id";


            if ($conn->query($sql) === TRUE) {

                header("Location: ./admin.php?page=mng");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Missing animal_id parameter";
        }
?>

