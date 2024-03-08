<?php
header("Content-Type: image/jpeg");

// Path to your font file
$font = 'imgs/cards/font.ttf';

// Load the image
$image = imagecreatefromjpeg('imgs/cards/template.jpg');

// Get the width and height of the image
list($imageWidth, $imageHeight) = getimagesize('imgs/cards/template.jpg');

// Define color
$color = imagecolorallocate($image, 19, 21, 22);

// Example name
$name = "Ankit Ankit Ankit Ankit";
$name = strtoupper($name);

// Calculate the text bounding box
$textBoundingBox = imagettfbbox(30, 0, $font, $name);
$textWidth = $textBoundingBox[4] - $textBoundingBox[0];
$textHeight = $textBoundingBox[1] - $textBoundingBox[5];

// Calculate x and y positions for centering text
$x_position = ($imageWidth - $textWidth) / 2;
$y_position = ($imageHeight + $textHeight) / 2;

// Add text to the image
imagettftext($image, 30, 0, $x_position, 640, $color, $font, $name);

// Example profile picture (replace with your code to fetch image data from database)
$profilePicture = imagecreatefromjpeg('imgs/defaultuser.png');

// Get the width and height of the profile picture
list($profileWidth, $profileHeight) = getimagesize('imgs/defaultuser.png');

// Calculate the position to place the profile picture (fixed position)
$profileX = 100; // X position of the profile picture
$profileY = 100; // Y position of the profile picture

// Create a transparent circular mask
$mask = imagecreatefrompng('imgs/cards/mask.png'); // Replace 'mask.png' with the path to your circular mask image

// Resize the mask to match the profile picture size
// $mask = imagescale($mask, $profileWidth, $profileHeight);

// Create a transparent image for the masked profile picture
$maskedProfile = imagecreatetruecolor($profileWidth, $profileHeight);
$transparent = imagecolorallocatealpha($maskedProfile, 0, 0, 0, 127);
imagefill($maskedProfile, 0, 0, $transparent);
imagesavealpha($maskedProfile, true);

// Apply the mask to the profile picture
imagecopy($maskedProfile, $profilePicture, 0, 0, 0, 0, $profileWidth, $profileHeight);
imagecopy($maskedProfile, $mask, 0, 0, 0, 0, $profileWidth, $profileHeight);

// Add the masked profile picture to the image
imagecopy($image, $maskedProfile, $profileX, $profileY, 0, 0, $profileWidth, $profileHeight);

// Output the image
imagejpeg($image);

// Destroy the image resources to free memory
imagedestroy($image);
imagedestroy($profilePicture);
imagedestroy($mask);
imagedestroy($maskedProfile);
?>