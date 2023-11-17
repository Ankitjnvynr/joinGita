<?php
include("../partials/_db.php");

echo false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = '../masik_parwas/';
    if (!empty($_FILES["masikimage"]["name"])) {
        $fileName = basename($_FILES["masikimage"]["name"]);
        
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            // echo 'Please select a file to upload.';
            if (move_uploaded_file($_FILES["masikimage"]["tmp_name"], $targetFilePath)) {
                
                $updateImg = true;
                if ($updateImg) {
                    echo "Picture Uploaded successfully.";
                    // Insert image file name into database 
                    $usql = "INSERT INTO `masik_parvas`( `pic`, `stat`) VALUES ('$fileName','1')";
                    $update = mysqli_query($conn, $usql);
                    $update = true;
                } else {
                    echo "File upload failed, please try again.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo 'Sorry, it is not JPG, JPEG, PNG, or GIF files.';
        }
    }
}
