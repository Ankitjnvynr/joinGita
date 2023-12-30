<?php
include("../partials/_db.php");
$newStr = null;

$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

$filters = array();
$byPhone = $_POST['phone'];
$byName = $_POST['filterName'];
$byEmail = $_POST['filterEmail'];
$byCountry = $_POST['filterCountry'];
$byState = $_POST['filterState'];
$byCity = $_POST['filterCity'];
$limit =  $_POST['limit'] ;
$start = $_POST['start'] ;

if($byPhone || $byEmail || $byCountry || $byState || $byCity || $byName){
    $newStr = ' WHERE ';
}

if($byCountry){
    // unset($filters[1]);
    // unset($filters[2]);
    $filters = array();
    $byCountry = " country LIKE '".$byCountry."%'";
    // array_splice($filters, 1, 2);  
    array_push($filters,$byCountry);
}
if($byName){
    $byName = " name LIKE '".$byName."%'";
    array_push($filters,$byName);
}
if($byState){
    $byState = " state LIKE '".$byState."%'";
    array_push($filters,$byState);
}
if($byCity){
    $byCity = " district LIKE '".$byCity."%'";
    array_push($filters,$byCity);
}
if($byPhone){
    $byPhone = " phone LIKE '".$byPhone."%'";
    array_push($filters,$byPhone);
}
if($byEmail){
    $byEmail = " email LIKE '%".$byEmail."%'";
    array_push($filters,$byEmail);
}

// echo var_dump($filters);
$newStr = $newStr.implode(" AND ", $filters);
// echo ($newStr);

$sql = "SELECT * FROM `users`  ".$newStr."  ORDER BY `id` DESC LIMIT ".$start." , ".$limit." ";

// echo $sql;
// SELECT * FROM `users` WHERE phone LIKE '89%' AND name LIKE '%an%' ORDER BY `id` DESC LIMIT 3;
$result = mysqli_query($conn, $sql);
// if(($conn->num_rows = mysqli_num_rows($result)) == 0) echo "<div class='card p-3 text-center overflow-hidden'><h2 class = 'text-muted' > No result Found </h2> </div>";
while ($row = mysqli_fetch_array($result)) {
    
    $user_id = $row['id'];
    $country = $row['country'];
    $name = $row['name'];
    $phone = $row['phone'];
    $whatsapp = $row['whtsapp'];
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
    $message = $row['message'];
    $pic = $row['pic'];
    echo '
                            <div class="card p-0 overflow-hidden">
                                <div class="d-flex picbg">
                                <div style="width:25%" class="pic relative m-2">
                                    <img style="border:2px solid white" class="absolute rounded-circle bg-white border-danger p-1" width="100%"
                                    src="../imgs/' . $pic . '" alt="' . $pic . '">
                                    
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
                                            <td>' . $phone . '</td>
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
                                <div class="d-flex gap-2 p-3 justify-content-between">
                                    <div class="d-flex gap-2 ">
                                        <a href="update.php?user=' . $user_id . '" class="btn btn-danger">Edit</a>
                                        <div data-id = "' . $user_id . '" class="del btn btn-danger" >Delete</div>
                                    </div>
                                    <p class="d-flex gap-3 flex-items-center justify-content-beteen px-2 m-0">
                                        <a href="tel:' . $phone . '"><i class="fa-solid fa-phone text-success fs-2"></i> </a>
                                        <a href="https://wa.me/' . $phone . '?text=hello world!&file=../imgs/' . $pic . '
                                        " target="_blank"><i class="fa-solid fs-2  fa-brands fa-whatsapp text-success "></i></a>
                                        <a href="mailto:' . $email . '"><i class="fa-solid fs-2   fa-envelope text-success "></i></a>
                                    </p>
                                </div>
                            </div>
                            ';
}

?>