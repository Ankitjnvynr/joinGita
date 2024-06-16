<?php

function send_wa_messages($name, $country_code, $phone,  $message, $filePath, $caption, )
{
    $phone = $country_code . $phone; // adding country code to mobile 

    // API URL
    $base_url = 'https://app.jflindia.co.in/api/v1/message/create';

    // Data to be sent as query parameters
    $data = array(
        'username' => 'gieo',
        'password' => htmlspecialchars('Gieo@2024'),
        'receiverMobileNo' => htmlspecialchars($phone),
        'message' => htmlspecialchars($message),
        'filePathUrl' => htmlspecialchars($filePath),
        'caption'=>htmlspecialchars($caption),
    );

    // Build the full URL with query parameters
    $url = $base_url . '?' . http_build_query($data);
    
    // Initialize cURL session
    $ch = curl_init($url);

    // Configure cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false)
    {
        curl_close($ch);
        return curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the response
    return json_decode($response, true);

 

}
?>