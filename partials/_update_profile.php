<?php 

if (isset($_POST['Update'])) {
    $targetDir = "imgs/";
    $updateEmail = $_POST['updateEmail'];
    $memberId = $_GET['member'];

    if (!empty($_FILES["pic"]["name"])) {
        $fileName = basename($_FILES["pic"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            $memberId = $_GET['member'];
            $sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $statusMsg = 'Please select a file to upload.';
            $fileNameUnlink = $row['pic'];
            if ($fileNameUnlink != 'defaultusers.png') {
                unlink($targetDir . $fileNameUnlink);
            }
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $targetFilePath)) {
                $updateImg = true;
                if ($updateImg) {
                    $statusMsg = "Picture Updated successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $memberId = $_GET['member'];
        $sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $statusMsg = 'Please select a file to upload.';
        $fileName = $row['pic'];
    }
    // Insert image file name into database 
    $usql = "UPDATE `users` SET `email`='$updateEmail', `pic`='$fileName' WHERE `hash_id` = '$memberId'";
    $update = mysqli_query($conn, $usql);
    $update = true;
}
 ?>