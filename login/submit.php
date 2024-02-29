<?php
include("../partials/_db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form was submitted
    if (isset($_POST['updatesubmit'])) {
        $phone = $_POST["phone"];
        $country = $_POST["country"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $dikshit = $_POST["dikshit"];
        $married = $_POST["married"];
        $state = $_POST["state"];
        $district = $_POST["district"];
        $tehsil = $_POST["tehsil"];
        $address = $_POST["address"];
        $occupation = $_POST["occupation"];
        $intrest = $_POST["intrest"];
        $education = $_POST["education"];
        $dob = $_POST["dob"];
        $aniver_date = isset($_POST['aniver_date']) ? $_POST['aniver_date'] : "";
        
        // Construct the UPDATE query
        $sql = "UPDATE `users` SET 
                `country`='$country', 
                `name`='$name', 
                `email`='$email', 
                `dikshit`='$dikshit', 
                `marital_status`='$married', 
                `state`='$state', 
                `district`='$district', 
                `tehsil`='$tehsil', 
                `address`='$address', 
                `occupation`='$occupation', 
                `interest`='$intrest', 
                `education`='$education', 
                `dob`='$dob', 
                `aniver_date`='$aniver_date' 
                WHERE `phone`='$phone'";
        
        // Execute the query
        $result = mysqli_query($conn, $sql);
        
        // Check if the query was successful
        if ($result) {
            // Redirect to the profile view page
            header("location:all-card.php?updated=true");
            echo "update success! <br>";
            echo $sql;

            exit;
        } else {
            // Handle errors if the query fails
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
$conn->close();
?>
