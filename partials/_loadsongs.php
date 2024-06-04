<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the directory where your songs are stored (same directory as the PHP script)
$directory = '../audio/';

// Get all files in the directory
$files = scandir($directory);



// Filter out non-song files (you can adjust this as needed)
$songs = array_filter($files, function($file) use ($directory) {
    // Check if the file is a regular file and has an mp3 extension
    return is_file($directory . DIRECTORY_SEPARATOR . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'mp3';
});

// Output contents of the $songs array (for debugging)
// echo "MP3 Files: <pre>";
// print_r($songs);
// echo "</pre>";

// Now $songs array contains all the mp3 files in the directory
// You can loop through $songs to display them or do any other operation
$sr = 0;
foreach ($songs as $song) {
    // echo $song . "<br>";
    echo '<li id="' . $sr . '" onclick="playsong(this)"   class="list-group-item music-item " data-src="audio/' . $song . '" data-cover="images/cover1.jpg">' . $song . '</li>';
    $sr++;
}
?>