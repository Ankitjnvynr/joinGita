<?php
$newStr = "";
include("../../partials/_db.php");

$currentURL = "https://$_SERVER[HTTP_HOST]/";
$response = [];

// Default SQL query
$sql = "SELECT * FROM `users`";

// Fetch filter values
$byCountry = !empty($_POST['filterCountry']) ? $_POST['filterCountry'] : null;
$byState = !empty($_POST['filterState']) ? $_POST['filterState'] : null;
$filterdistrict = !empty($_POST['filterdistrict']) ? $_POST['filterdistrict'] : null;
$bytehsil = !empty($_POST['bytehsil']) ? $_POST['bytehsil'] : null;
$dikshit = !empty($_POST['dikshit']) ? $_POST['dikshit'] : null;
$executive = !empty($_POST['executive']) ? $_POST['executive'] : null;
$trustee = !empty($_POST['trustee']) ? $_POST['trustee'] : null;
$birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;
$birthMonth = isset($_POST['birthMonth']) ? $_POST['birthMonth'] : null;
$aniDate = isset($_POST['aniDate']) ? $_POST['aniDate'] : null;
$aniMonth = isset($_POST['aniMonth']) ? $_POST['aniMonth'] : null;
$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : null;
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : null;
$selectedMediaIds = isset($_POST['selectedMedia']) ? json_decode($_POST['selectedMedia'], true) : [];

// Initialize filters array
$filters = [];

// Apply filters to SQL query
if ($byCountry) {
    $filters[] = "country LIKE '" . $conn->real_escape_string($byCountry) . "%'";
}
if ($byState) {
    $filters[] = "state LIKE '" . $conn->real_escape_string($byState) . "%'";
}
if ($filterdistrict) {
    $filters[] = "district LIKE '" . $conn->real_escape_string($filterdistrict) . "%'";
}
if ($bytehsil) {
    $filters[] = "tehsil LIKE '" . $conn->real_escape_string($bytehsil) . "%'";
}
if ($dikshit) {
    if($dikshit=='Yes'||$dikshit=='No'){
        $filters[] = "dikshit LIKE '" . $conn->real_escape_string($dikshit) . "%'";
    }else{
        $filters[] = "dikshit LIKE '" . $conn->real_escape_string($dikshit) . "%' AND dt > '2024-06-01' ";
    }
}
if ($birthDate) {
    $filters[] = "DAY(dob) = " . intval($birthDate);
}
if ($birthMonth) {
    $filters[] = "MONTH(dob) = " . intval($birthMonth);
}
if ($aniDate) {
    $filters[] = "DAY(aniver_date) = " . intval($aniDate);
}
if ($aniMonth) {
    $filters[] = "MONTH(aniver_date) = " . intval($aniMonth);
}
if ($executive) {
    $filters[] = "designation != 'Member'";
}
if ($trustee) {
    $filters[] = "star != ''";
}
if ($fromDate && $toDate) {
    // Ensure proper date formatting
    $fromDate = date('Y-m-d', strtotime($fromDate));

    // Create a DateTime object for toDate
    $toDateTime = new DateTime($toDate);
    // Add one day
    $toDateTime->modify('+1 day');
    // Format the new toDate
    $toDate = $toDateTime->format('Y-m-d');

    // Add filter to the array
    $filters[] = "dt BETWEEN '$fromDate' AND '$toDate'";
}


// Build SQL query with filters
if (!empty($filters)) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}
$sql .= " ORDER BY name ASC";
// echo $sql;

// Fetch selected media paths and captions
$mediaPaths = [];
$mediaCaptions = [];
if (!empty($selectedMediaIds)) {
    $ids = implode(",", array_map('intval', $selectedMediaIds));
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
    if (intval(ltrim($birthDate, '0')) === intval($currentDay) && intval(ltrim($birthMonth, '0')) === intval($currentMonth)) {
        $allMediaStr = "https://parivaar.gieogita.org/login/bday.jpg";
        $allCaptionStr = "जन्मदिवस की शुभकामना";
    } else {
        $allMediaStr = "https://parivaar.gieogita.org/login/advance.jpg";
        $allCaptionStr = "🌹संत सेवा..भंडारा..गौसेवा";
    }
}

if ($aniDate && $aniMonth) {
    if (intval($aniDate) == $currentDay && intval($aniMonth) == $currentMonth) {
        $allMediaStr = "https://parivaar.gieogita.org/login/anniversary.jpg";
        $allCaptionStr = "वैवाहिक वर्षगांठ की शुभकामना";
    } else {
        $allMediaStr = "https://parivaar.gieogita.org/login/advance.jpg";
        $allCaptionStr = "🌹संत सेवा..भंडारा..गौसेवा";
    }
}

if ($fromDate && $toDate) {
    $allMediaStr = "https://parivaar.gieogita.org/login/joiningpic.jpg";
    $allCaptionStr = "🌹अष्टादश श्लोकी गीता पाठ";
}


// Country codes
$country_code = [
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
];

// Fetch message
$messageSelect = isset($_POST['messageSelect']) ? $_POST['messageSelect'] : '';
$msgsql = "SELECT * FROM `messages` WHERE `title` = '" . $conn->real_escape_string($messageSelect) . "'";
$msgresult = mysqli_query($conn, $msgsql);

$msgrow = mysqli_fetch_assoc($msgresult);
$message = $msgrow['msg'];

// Execute query and process results
$users = [];
$result = $conn->query($sql);
$totalresult = mysqli_num_rows($result);

if ($totalresult > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $code = isset($country_code[$row['country']]) ? $country_code[$row['country']] : '';
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
            'message' => 'गीता प्रिय ' . $row['name'] . ' जी , 🌹 * जय श्री कृष्ण * 🌹 ' . urldecode(html_entity_decode($message)) . ' To view profile Click here- ' . $currentURL . 'member.php?member=' . md5($row['phone']),

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
