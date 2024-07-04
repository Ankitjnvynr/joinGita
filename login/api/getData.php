<?php
$newStr = "";
include ("../../partials/_db.php");

$currentURL = "https://$_SERVER[HTTP_HOST]/";
$response = [];


$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";
$filters = array();
$byCountry = !empty($_POST['filterCountry']) ? $_POST['filterCountry'] : null;
$byState = !empty($_POST['filterState']) ? $_POST['filterState'] : null;
$filterdistrict = !empty($_POST['filterdistrict']) ? $_POST['filterdistrict'] : null;
$bytehsil = !empty($_POST['bytehsil']) ? $_POST['bytehsil'] : null;

$selectedMediaIds = isset($_POST['selectedMedia']) ? json_decode($_POST['selectedMedia'], true) : [];


if ($byCountry || $byState || $filterdistrict || $bytehsil)
{
    $newStr = ' WHERE ';
}

if ($byCountry)
{
    $byCountry = " country LIKE '" . $byCountry . "%'";
    array_push($filters, $byCountry);
}
if ($byState)
{
    $byState = " state LIKE '" . $byState . "%'";
    array_push($filters, $byState);
}
if ($filterdistrict)
{
    $filterdistrict = " district LIKE '" . $filterdistrict . "%'";
    array_push($filters, $filterdistrict);
}
if ($bytehsil)
{
    $bytehsil = " tehsil LIKE '" . $bytehsil . "%'";
    array_push($filters, $bytehsil);
}

$newStr = $newStr . implode(" AND ", $filters);
$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY name ASC;";

// Fetch selected media paths and captions
$mediaPaths = [];
$mediaCaptions = [];
if (!empty($selectedMediaIds))
{
    $ids = implode(",", $selectedMediaIds);
    $mediaSql = "SELECT image_path, image_caption FROM api_content WHERE id IN ($ids)";
    $mediaResult = $conn->query($mediaSql);

    while ($mediaRow = $mediaResult->fetch_assoc())
    {
        $mediaPaths[] = $mediaRow['image_path'];
        $mediaCaptions[] = $mediaRow['image_caption'];
    }
}

function convert_to_str($arr, $currentURL)
{
    $prefix = $currentURL . 'imgs/api_content/';
    $prefixedArray = array_map(function ($item) use ($prefix) {
        return $prefix . $item;
    }, $arr);
    return implode(',', $prefixedArray);
}
$allMediaStr = convert_to_str($mediaPaths, $currentURL);
$allCaptionStr = implode(',', $mediaCaptions);

$country_code = array(
    "Australia" => "61",
    "Canada" => "1",
    "United Kingdom" => "44",
    "United Kingdom " => "44",
    "United kingdom" => "44",
    "India" => "91",
    "Japan" => "81",
    "New Zealand" => "64",
    "United Arab Emirates" => "971",
    "UAE (United Arab Emirates)" => "971",
    "United States" => "1",
    "USA" => "1",
    "UK" => "+44",
    "England" => "+44",
    "Malaysia" => "+60",
);


$messageSelect = isset($_POST['messageSelect']) ? $_POST['messageSelect'] : '';
$msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
$msgresult = mysqli_query($conn, $msgsql);

$msgrow = mysqli_fetch_assoc($msgresult);
$message = $msgrow['msg'];

$users = [];
$result = $conn->query($sql);
$totalresult = mysqli_num_rows($result);
if ($totalresult > 0)
{
    while ($row = mysqli_fetch_array($result))
    {
        $code = $country_code[$row['country']];
        $user = [
            'id' => $row['id'],
            'country' => $row['country'],
            'name' => $row['name'],
            'phone' => $code . $row['phone'],
            'designation' => $row['designation'],
            'email' => $row['email'],
            'dikshit' => $row['dikshit'],
            'marital_status' => $row['marital_status'],
            'state' => $row['state'],
            'district' => $row['district'],
            'tehsil' => $row['tehsil'],
            'address' => $row['address'],
            'wing' => $row['interest'],
            'occupation' => $row['occupation'],
            'education' => $row['education'],
            'dob' => $row['dob'],
            'aniver_date' => $row['aniver_date'],
            'joinOn' => $row['dt'],
            'pic' => $row['pic'],
            'message' => 'गीता प्रिय ' . $row['name'] . ' जी , 🌹 * जय श्री कृष्ण * 🌹 ' . urldecode(html_entity_decode($message)) . ' To view profile Click here- ' . $currentURL . 'member.php?member=' . md5($row['phone'])
        ];
        $users[] = $user;
    }
    $response['users'] = $users;
} else
{
    $response['users'] = [];
}

$response['mediaPaths'] = $allMediaStr;
$response['mediaCaptions'] = $allCaptionStr;



header('Content-Type: application/json');
echo json_encode($response);