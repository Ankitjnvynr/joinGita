<?php

$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$filePath = isset($_POST['filePath']) ? $_POST['filePath'] : '';
$captions = isset($_POST['caption']) ? $_POST['caption'] : '';

// Debugging: Output received data for verification
// var_dump($phone, $message, $filePath, $captions);

// Prepare file paths and captions as arrays
$files = isset($filePath) ? explode(',', $filePath) : [];
$captions = isset($captions) ? explode(',', $captions) : [];

// Encode file paths and captions
$files = array_map('htmlspecialchars', $files);
$captions = array_map('htmlspecialchars', $captions);

// API URL
$base_url = 'https://app.jflindia.co.in/api/v1/message/create';

// Data to be sent as query parameters
$data = array(
    'username' => 'gieo2024',
    'password' => htmlspecialchars('Gieo@2024'),
    'receiverMobileNo' => htmlspecialchars($phone),
    'message' => htmlspecialchars($message),
    'filePathUrl' => implode('&filePathUrl=', $files), // Join file paths with commas
    'caption' => implode('&caption=', $captions), // Join captions with commas
);

// Build the full URL with query parameters
echo $url = $base_url . '?' . http_build_query($data);


// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    $error_msg = curl_error($ch);
    curl_close($ch);
    die('Curl error: ' . $error_msg); // Output error and terminate script
}

// Get HTTP response code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check HTTP status code for errors
if ($http_code >= 400) {
    curl_close($ch);
    die('HTTP error: ' . $http_code); // Output error and terminate script
}

// Close cURL session
curl_close($ch);

// Decode the response
$decoded_response = json_decode($response, true);

// Check if response decoding failed
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON decoding error: ' . json_last_error_msg()); // Output error and terminate script
}

// Output the decoded response for debugging
var_dump($decoded_response);

// Return the decoded response
return $decoded_response;
