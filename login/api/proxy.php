<?php
// Ensure the session is started and user is authenticated
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

// Check if the URL parameter is set and secure it (against any path traversal attacks)
if (!isset($_GET[''])) {
    header("HTTP/1.1 400 Bad Request");
    exit;
}

$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false); // Optional: include headers in the output

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Output the response from the remote server
echo $response;
?>
