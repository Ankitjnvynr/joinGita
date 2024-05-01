<?php
include ("../partials/_db.php");

$currentURL = "http://$_SERVER[HTTP_HOST]/";


$msgs = array();
$defaultmsg = array();
$msgsql = "SELECT title, msg FROM `messages` ";
$allmsg = $conn->query($msgsql);
while ($allmsgs = mysqli_fetch_assoc($allmsg))
{
    array_push($msgs, '<option value="' . urldecode($allmsgs['msg']) . '">' . $allmsgs['title'] . '</option>');
    array_push($defaultmsg, $allmsgs['msg']);

}
$msgStr = '<select name="message" onchange="selectMessage(this)" id="message">' . implode("", $msgs) . '</select>';

$newStr = null;

$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

$filters = array();
$byPhone = $_POST['phone'];
$byName = $_POST['filterName'];
$byEmail = $_POST['filterEmail'];
$byCountry = $_POST['filterCountry'];
$byState = $_POST['filterState'];
$filterdistrict = $_POST['filterDistrict'];
$bytehsil = $_POST['filterTehsil'];
$limit = $_POST['limit'];
$start = $_POST['start'];

// ----------------------from another --------------------


// $bydikshit = $_POST['filterDikshit'];

// if ($bydikshit)
// {
//     $bydikshit = " dikshit LIKE '" . $bydikshit . "%'";
//     array_push($filters, $bydikshit);
// }
// ----------------------from another --------------------



if ($byPhone || $byEmail || $byCountry || $byState || $bytehsil || $byName)
{
    $newStr = ' WHERE ';
}

if ($byCountry)
{
    // unset($filters[1]);
    // unset($filters[2]);
    $filters = array();
    $byCountry = " country LIKE '" . $byCountry . "%'";
    // array_splice($filters, 1, 2);  
    array_push($filters, $byCountry);
}
if ($byName)
{
    $byName = " name LIKE '" . $byName . "%'";
    array_push($filters, $byName);
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
if ($byPhone)
{
    $byPhone = " phone LIKE '" . $byPhone . "%'";
    array_push($filters, $byPhone);
}
if ($byEmail)
{
    $byEmail = " email LIKE '%" . $byEmail . "%'";
    array_push($filters, $byEmail);
}

// echo var_dump($filters);
$newStr = $newStr . implode(" AND ", $filters);
// echo ($newStr);

$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY `id` DESC LIMIT " . $start . " , " . $limit . " ";

// echo $sql;
// SELECT * FROM `users` WHERE phone LIKE '89%' AND name LIKE '%an%' ORDER BY `id` DESC LIMIT 3;
$result = mysqli_query($conn, $sql);
// if(($conn->num_rows = mysqli_num_rows($result)) == 0) echo "<div class='card p-3 text-center overflow-hidden'><h2 class = 'text-muted' > No result Found </h2> </div>";
while ($row = mysqli_fetch_array($result))
{

    $user_id = $row['id'];
    $country = $row['country'];
    $name = $row['name'];
    $phone = $row['phone'];
    $designation = $row['designation'];
    $email = $row['email'];
    $dikshit = $row['dikshit'];
    $marital_status = $row['marital_status'];
    $state = $row['state'];
    $district = $row['district'];
    $tehsil = $row['tehsil'];
    $address = $row['address'];
    $wing = $row['interest'];
    $occupation = $row['occupation'];
    $education = $row['education'];
    $dob = $row['dob'];
    $aniver_date = $row['aniver_date'];
    // $message = $row['message'];
    $pic = $row['pic'];




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
        "United kingdom" => "+44",
        "United Kingdom " => "+44",
        "Malaysia" => "+60",
        "" => "+91",
    );

    $code = $country_code[$country];

    echo '
                            <div class="card p-0 overflow-hidden">
                                <div class="d-flex picbg">
                                <div style="width:100px; height:100px" class="pic relative m-2">
                                <label for="changeImgs" >
                                    <img onclick="getPicId(this,' . $user_id . ')" style="border:2px solid white; aspect-ratio:1/1;  width:100%;" class="absolute rounded-circle bg-white border-danger p-1" style=";" src="../imgs/' . $pic . '" alt="' . $pic . '">
                                </label>
                                </div>
                                <div style="width:67%" class="name d-flex flex-column justify-content-around">
                                    <h2 class="card-title m-0 p-0 fs-4" style="text-transform: lowercase; text-transform: capitalize;">' . $name . '</h2>
                                    <div class="phone d-flex flex-column-reverse text-danger  align-items-around">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Wing:</td>
                                            <td>' . $wing . '</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            
                                            <td><a style="text-decoration:none;" href="tel:' . $phone . '"><span  class="text-black" >' . $phone . '</span></a></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>' . $email . '</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    
                                    </div>
                                </div>
                                </div>
                                <hr class="m-0 mx-3 ">
                                <div class="d-flex gap-2 p-2 justify-content-between">
                                    <div class="d-flex gap-2 ">
                                        <button onclick="editProfileDetail(' . $user_id . ')">edit</button>
                                        <a href="update.php?user=' . $user_id . '" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <div data-id = "' . $user_id . '" class="del btn btn-danger" ><i class="fa-solid fa-trash"></i></div>
                                    </div>
                                    <p class="d-flex flex-wrap gap-2 flex-items-center justify-content-between px-2 m-0">
                                        ' . $msgStr . '
                                        <a href="https://wa.me/' . $code . $phone . '?file=../imgs/' . $pic . '&text=%0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $defaultmsg[0] . '%0A %0ATo view profile Click here- ' . $currentURL . 'member.php?member=' . md5($phone) . '"><i class="fa-solid fs-2 fa-brands fa-whatsapp text-success fs-2"></i></a>
                                        
                                        <a href="mailto:' . $email . '"><i class="fa-solid fs-2   fa-envelope text-success "></i></a>
                                    </p>
                                </div>
                            </div>
                            ';
}
?>