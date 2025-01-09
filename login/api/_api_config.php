<?php

header('Content-Type: application/json'); // Set the content type to JSON

$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$filePath = isset($_POST['filePath']) ? $_POST['filePath'] : '';
$captions = isset($_POST['caption']) ? $_POST['caption'] : '';

// Prepare file paths and captions as arrays
$files = isset($filePath) ? explode(',', $filePath) : [];
$captions = isset($captions) ? explode(',', $captions) : [];

// Encode file paths and captions
$files = array_map('htmlspecialchars', $files);
$captions = array_map('htmlspecialchars', $captions);

// API URL
$base_url = 'http://app.jflindia.co.in/api/v1/message/create';

// Data to be sent as query parameters
$data = array(
    'username' => 'gieo2024',
    'password' => htmlspecialchars('Gieo@2024'),
    'receiverMobileNo' => htmlspecialchars($phone),
    'message' => htmlspecialchars($message),
    'filePathUrl' => implode('&filePathUrl=', $files),
    'caption' => implode('&caption=', $captions),
);

// Build the full URL with query parameters
$url = $base_url . '?' . http_build_query($data);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false)
{
    $error_msg = curl_error($ch);
    curl_close($ch);
    echo json_encode(['error' => 'Curl error: ' . $error_msg]);
    exit; // Terminate script
}

// Get HTTP response code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check HTTP status code for errors
if ($http_code >= 400)
{
    curl_close($ch);
    echo json_encode(['error' => 'HTTP error: ' . $http_code]);
    exit; // Terminate script
}

// Close cURL session
curl_close($ch);

// Decode the response
$decoded_response = json_decode($response, true);

// Check if response decoding failed
if (json_last_error() !== JSON_ERROR_NONE)
{
    echo json_encode(['error' => 'JSON decoding error: ' . json_last_error_msg()]);
    exit; // Terminate script
}

// Output the decoded response as JSON
echo json_encode($decoded_response);
?>