<?php
$newStr = "";
include("../../partials/_db.php");

$currentURL = "https://$_SERVER[HTTP_HOST]/";
$response = [];


$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";
$filters = array();
$byCountry = !empty($_POST['filterCountry']) ? $_POST['filterCountry'] : null;
$byState = !empty($_POST['filterState']) ? $_POST['filterState'] : null;
$filterdistrict = !empty($_POST['filterdistrict']) ? $_POST['filterdistrict'] : null;
$bytehsil = !empty($_POST['bytehsil']) ? $_POST['bytehsil'] : null;
$dikshit = !empty($_POST['dikshit']) ? $_POST['dikshit'] : null;

// geting birth date and birth month
$birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;
$birthMonth = isset($_POST['birthMonth']) ? $_POST['birthMonth'] : null;

//getting aniversary date and month 
$aniDate = isset($_POST['aniDate']) ? $_POST['aniDate'] : null;
$aniMonth = isset($_POST['aniMonth']) ? $_POST['aniMonth'] : null;

$selectedMediaIds = isset($_POST['selectedMedia']) ? json_decode($_POST['selectedMedia'], true) : [];


if ($birthDate && $birthMonth) {
    $bd = $birthDate;
    $bm = $birthMonth;
}
if ($aniDate && $aniMonth) {
    $ad = $aniDate;
    $am = $aniMonth;
}


if ($byCountry || $byState || $filterdistrict || $bytehsil || $dikshit || $birthDate || $birthMonth || $aniDate || $aniMonth) {
    $newStr = ' WHERE ';
}

if ($byCountry) {
    $byCountry = " country LIKE '" . $byCountry . "%'";
    array_push($filters, $byCountry);
}
if ($byState) {
    $byState = " state LIKE '" . $byState . "%'";
    array_push($filters, $byState);
}
if ($filterdistrict) {
    $filterdistrict = " district LIKE '" . $filterdistrict . "%'";
    array_push($filters, $filterdistrict);
}
if ($bytehsil) {
    $bytehsil = " tehsil LIKE '" . $bytehsil . "%'";
    array_push($filters, $bytehsil);
}
if ($dikshit) {
    $dikshit = " dikshit LIKE '" . $dikshit . "%'";
    array_push($filters, $dikshit);
}
if ($birthDate) {
    $birthDate = " DAY(dob) = " . $birthDate;
    array_push($filters, $birthDate);
}
if ($birthMonth) {
    $birthMonth = " MONTH(dob) = " . $birthMonth;
    array_push($filters, $birthMonth);
}
if ($aniDate) {
    $aniDate = " DAY(aniver_date) = " . $aniDate;
    array_push($filters, $aniDate);
}
if ($aniMonth) {
    $aniMonth = " MONTH(aniver_date) = " . $aniMonth;
    array_push($filters, $aniMonth);
}

$newStr = $newStr . implode(" AND ", $filters);
$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY name ASC;";

// Fetch selected media paths and captions
$mediaPaths = [];
$mediaCaptions = [];
if (!empty($selectedMediaIds)) {
    $ids = implode(",", $selectedMediaIds);
    $mediaSql = "SELECT image_path, image_caption FROM api_content WHERE id IN ($ids)";
    $mediaResult = $conn->query($mediaSql);

    while ($mediaRow = $mediaResult->fetch_assoc()) {
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

$currentDay = date('j'); // day of the month without leading zero
$currentMonth = date('n'); // month without leading zero



if ($birthDate && $birthMonth) {
    if (intval(ltrim($bd, '0')) === intval($currentDay) && intval(ltrim($bm, '0')) === intval($currentMonth)) {
        $allMediaStr = "https://parivaar.gieogita.org/login/bday.jpg";
        $allCaptionStr = "जन्मदिवस की शुभकामना";
    } else {
        $allMediaStr = "https://parivaar.gieogita.org/login/advance.jpg";
        $allCaptionStr = "संत सेवा...भंडारा सेवा";
    }
    // $dates = [
    //     'cd' => $currentDay,
    //     'cm' => $currentMonth,
    //     'bd' => $bd,
    //     'bm' => $bm,
    // ];
    // $response['dates'] = $dates;
}
if ($aniDate && $aniMonth) {
    if (intval($ad) == $currentDay && intval($am) == $currentMonth) {
        $allMediaStr = "https://parivaar.gieogita.org/login/anniversary.jpg";
        $allCaptionStr = "वैवाहिक वर्षगांठ की शुभकामना";
    } else {
        $allMediaStr = "https://parivaar.gieogita.org/login/advance.jpg";
        $allCaptionStr = "संत सेवा...भंडारा सेवा";
    }
}

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
if ($totalresult > 0) {
    while ($row = mysqli_fetch_array($result)) {
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
} else {
    $response['users'] = [];
}

$response['mediaPaths'] = $allMediaStr;
$response['mediaCaptions'] = $allCaptionStr;

header('Content-Type: application/json');
echo json_encode($response);
