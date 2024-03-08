<?php
header("Content-Type: image/jpeg");





include("partials/_db.php");
if (!isset($_GET['member'])) {
    // header('location:view-profile.php');
    exit;
}
$memberId = false;
$memberId = $_GET['member'];
$sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (!$row) {
    echo "not";
    // header("location:view-profile.php?pnot=true");
}




// Path to your font file
$font = 'imgs/cards/font.ttf';
$profile = 'imgs/'. $row['pic'];
$name = $row['name'];
$city = $row['district'];
$phone =  $row['phone'];
$wing = $row['interest'];
$designation = $row['designation'];
$star = "";

header("Content-Disposition: attachment; filename=\"$name$phone.jpg\"");


// Load the image
$image = imagecreatefromjpeg('imgs/cards/template.jpg');

// Get the width and height of the image
list($imageWidth, $imageHeight) = getimagesize('imgs/cards/template.jpg');

// Define color
$color = imagecolorallocate($image, 19, 21, 22);

// Example name

$name = strtoupper($name);

// Calculate the text bounding box
$textBoundingBox = imagettfbbox(30, 0, $font, $name);
$textWidth = $textBoundingBox[4] - $textBoundingBox[0];
$textHeight = $textBoundingBox[1] - $textBoundingBox[5];

// Calculate x and y positions for centering text
$x_position = ($imageWidth - $textWidth) / 2;
$y_position = ($imageHeight + $textHeight) / 2;

// Add text to the image

// Example profile picture (replace with your code to fetch image data from database)
$profilePicture = imagecreatefromjpeg($profile);

// Get the width and height of the profile picture
list($profileWidth, $profileHeight) = getimagesize('imgs/defaultuser.png');

// Calculate the position to place the profile picture (fixed position)
$profileX = 100; // X position of the profile picture
$profileY = 100; // Y position of the profile picture

// Create a transparent circular mask
$mask = imagecreatefrompng('imgs/cards/mask.png'); // Replace 'mask.png' with the path to your circular mask image




$profilePicture = imagescale($profilePicture, 345, 345);
$mask = imagescale($mask, $imageWidth , $imageHeight);
// Add the masked profile picture to the image
imagecopy($image, $profilePicture, 120, 231 , 0, 0, 345, 345);
imagecopy($image, $mask, 0, 0, 0, 0, $imageWidth, $imageHeight);
imagettftext($image, 30, 0, $x_position, 640, $color, $font, $name);
imagettftext($image, 17, 0,200, 727, $color, $font, $city);
imagettftext($image, 17, 0,200, 768, $color, $font, $phone);
imagettftext($image, 17, 0,200, 809, $color, $font, $wing);
imagettftext($image, 17, 0,200, 845, $color, $font, $designation);
imagettftext($image, 17, 0,200, 884, $color, $font, $star);

// Output the image
imagejpeg($image,null,100);

// Destroy the image resources to free memory
imagedestroy($image);
imagedestroy($profilePicture);
imagedestroy($mask);
imagedestroy($maskedProfile);
?>