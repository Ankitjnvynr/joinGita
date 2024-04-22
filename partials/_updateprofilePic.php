<?php
include ("_db.php");

// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["croppedImage"]))
{
    // Get the cropped image data
    $croppedImageData = $_POST["croppedImage"];
    // Decode the base64 encoded image data
    $croppedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

    // Get the member ID
    echo "your member id is " . $memberId = $_POST['memberId'];

    // Get the existing image file name from the database or any other source
    $sql = "SELECT `pic` FROM `users` WHERE `hash_id` = '$memberId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $existingImage = $row['pic'];

    // Specify the directory where you want to save the uploaded image
    $uploadDirectory = "../imgs/";

    // Generate a unique filename for the new image
    $newImageName = uniqid() . '.png'; // You can use any desired extension

    // Save the cropped image to the server
    file_put_contents($uploadDirectory . $newImageName, $croppedImage);

    // Update the database with the new image filename
    $usql = "UPDATE `users` SET `pic`='$newImageName' WHERE `hash_id` = '$memberId'";
    $update = mysqli_query($conn, $usql);

    // Delete the existing image file if it's different from the default image
    if ($existingImage !== 'defaultusers.png')
    {
        $delfile = $uploadDirectory . $existingImage;
        if (unlink($delfile))
        {
            if ($update)
            {
                echo json_encode(["success" => true, "message" => "new image updated", "newImageName" => "$newImageName"]);
            }
        }
    }

    exit;
}

// Respond with an error message if the request is not via AJAX or missing required parameters
echo json_encode(["success" => false, "message" => "Invalid request"]);
