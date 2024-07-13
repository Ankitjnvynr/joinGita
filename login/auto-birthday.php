<?php
$currentURL = "http://$_SERVER[HTTP_HOST]/";

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}

include ("../partials/_db.php");

$totalBday = 0;
$birthday = null;

$birthDate = date('d');
$birthMonth = date('m');
$messageSelect = "Birthday";

$query = "SELECT * FROM users WHERE MONTH(dob) = $birthMonth AND DAY(dob) = $birthDate";
$resultb = mysqli_query($conn, $query);

$totalBday = mysqli_num_rows($resultb);

$msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
$msgresult = mysqli_query($conn, $msgsql);
$msgrow = mysqli_fetch_assoc($msgresult);
$message = urldecode($msgrow['msg']);

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

if ($totalBday > 0)
{
    while ($row = mysqli_fetch_assoc($resultb))
    {
        $code = $country_code[$row['country']];
        $targetDate = $row['dob'];

        $whatsappMessage = 'गीता प्रिय ' . $row['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $message . ' %0A %0ATo view profile Click here- ' . $currentURL . 'member.php?member=' . md5($row['phone']) . '&attachment=' . $currentURL . 'imgs/65f7fc772d3bf.png';
        $whatsappURL = "https://wa.me/{$code}{$row['phone']}?text=" . urlencode($whatsappMessage);

        // Here you can use cURL or file_get_contents to access the WhatsApp URL
        // Or simply log the URL for manual inspection
        file_get_contents($whatsappURL);
    }
}

$conn->close();
?>