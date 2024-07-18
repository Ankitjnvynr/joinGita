<?php
// send_messages.php

session_start();
include("../partials/_db.php");

$currentURL = "http://$_SERVER[HTTP_HOST]/";

$country_code = array(
    "Australia" => "61",
    "Canada" => "1",
    "United Kingdom" => "44",
    "India" => "91",
    "Japan" => "81",
    "New Zealand" => "64",
    "United Arab Emirates" => "971",
    "United States" => "1",
    "USA" => "1",
    "UK" => "+44",
    "England" => "+44",
    "Malaysia" => "+60",
    "Malaysia " => "+60",
);

function sendBirthdayMessages($conn, $currentURL, $country_code)
{
    $birthDate = date('d');
    $birthMonth = date('m');
    $messageSelect = "Birthday";

    $query = "SELECT * FROM users WHERE MONTH(dob) = $birthMonth AND DAY(dob) = $birthDate AND tehsil LIKE '%Bigbyte%'";
    $resultb = mysqli_query($conn, $query);

    $msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
    $msgresult = mysqli_query($conn, $msgsql);
    $msgrow = mysqli_fetch_assoc($msgresult);
    $message = $msgrow['msg'];



    while ($row = mysqli_fetch_assoc($resultb)) {
        $code = $country_code[$row['country']];
        $targetDate = $row['dob'];
        // $url = "https://wa.me/{$code}{$row['phone']}?text=गीता प्रिय {$row['name']} जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A{$message} %0A %0ATo view profile Click here- {$currentURL}member.php?member=" . md5($row['phone']) . "&attachment={$currentURL}imgs/65f7fc772d3bf.png";
        // // file_get_contents($url);
        // echo $url;
        $phone = $code . $row['phone'];
        $message = "गीता प्रिय {$row['name']} जी ,
🌹 जय श्री कृष्ण  🌹 
{$message} 

To view profile Click here- https://parivaar.gieogita.org/member.php?member=" . md5($row['phone']);


        $files =  "https://parivaar.gieogita.org/login/bday.jpg";
        $captions = "जन्मदिवस की  शुभकामना";



        // API URL
        $base_url = 'https://app.jflindia.co.in/api/v1/message/create';

        // Data to be sent as query parameters
        $data = array(
            'username' => 'gieo2024',
            'password' => htmlspecialchars('Gieo@2024'),
            'receiverMobileNo' => htmlspecialchars($phone),
            'message' => htmlspecialchars($message),
            'filePathUrl' => htmlspecialchars($files),
            'caption' => htmlspecialchars($captions),
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
        echo $response;
    }
}


sendBirthdayMessages($conn, $currentURL, $country_code);
